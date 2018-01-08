<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
error_reporting(E_ALL & ~E_NOTICE);
session_start();

use App\food;
use App\order;
use App\employee;
use App\transaction;
use App\feedback;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use DateTime;
date_default_timezone_set('Asia/Jakarta');
class pelanggan_controller extends Controller
{
    public function index(){
      if(!isset($_SESSION["nomeja"])){
          return redirect("/");
      }
      $APPS = food::select("no_hidangan as no","nama_hidangan as nama","kode_tipe","harga")
                      ->where([["status",1],["life_cycle",1],["kode_tipe","APP"]])->get();
      $MACS = food::select("no_hidangan as no","nama_hidangan as nama","kode_tipe","harga")
                      ->where([["status",1],["life_cycle",1],["kode_tipe","MAC"]])->get();
      $DESS = food::select("no_hidangan as no","nama_hidangan as nama","kode_tipe","harga")
                      ->where([["status",1],["life_cycle",1],["kode_tipe","DES"]])->get();
      $SOFS = food::select("no_hidangan as no","nama_hidangan as nama","kode_tipe","harga")
                      ->where([["status",1],["life_cycle",1],["kode_tipe","SOF"]])->get();
      $ceks = order::select("no_pemesanan","status_bayar as sts")->where("no_meja",$_SESSION["nomeja"])->whereIn("status_bayar",[0,1])->get();
      foreach ($ceks as $cek);
      if(!isset($_SESSION["no"])){
        if(count($ceks)>0){
          $_SESSION["no"] = $cek->no_pemesanan;
          $datas = transaction::select("transactions.no_hidangan as nohid",
                            "nama_hidangan as nama",
                            "harga","status_buat as sts","jml_item as jml","status_buat as sts")
                          ->join("foods","foods.no_hidangan","=","transactions.no_hidangan")
                          ->where("no_pemesanan",$_SESSION["no"])->get();
        }else{
          $nomors = order::select("no_pemesanan")->orderBy("no_pemesanan","desc")->limit(1)->sharedLock()->get();
          if(count($nomors)>0){
            foreach ($nomors as $nomor);
            $_SESSION["no"] = $nomor->no_pemesanan+1;
            order::insert(["no_pemesanan"=>$_SESSION["no"],"no_meja"=>$_SESSION["nomeja"],"tanggal"=>new DateTime]);
          }else{
            order::insert(["no_pemesanan"=>1,"no_meja"=>$_SESSION["nomeja"],"tanggal"=>new DateTime]);
            $_SESSION["no"] = 1;
          }
        }
      }else{
        $datas = transaction::select("transactions.no_hidangan as nohid",
                          "nama_hidangan as nama",
                          "harga","status_buat as sts","jml_item as jml","status_buat as sts")
                        ->join("foods","foods.no_hidangan","=","transactions.no_hidangan")
                        ->where("no_pemesanan",$_SESSION["no"])->get();
      }
      $_SESSION["statusbayar"] = $cek->sts;
      return view("pelanggan.index",compact(["APPS","MACS","DESS","SOFS","datas","statusbayar"]));
    }

    public function set_order($no){
      DB::beginTransaction();
      try {
        $ceks = transaction::select("no_hidangan as no","status_buat as sts")
        ->where([["no_pemesanan",$_SESSION["no"]],["no_hidangan",strip_tags($no)],["status_buat","=",0]])
        ->get();
        if(count($ceks)==0){
          $trans = transaction::select("no_transaksi as no")->orderBy("no_transaksi","desc")->limit(1)->sharedLock()->get();
          if (count($trans)>0) {
            foreach ($trans as $tran);
            $notrans = $tran->no + 1;
          }else{
            $notrans = 1;
          }
          transaction::lockForUpdate()->insert(["no_transaksi"=>$notrans,"no_pemesanan"=>$_SESSION["no"],"no_hidangan"=>strip_tags($no)]);
        }else{
          transaction::where([["no_pemesanan",$_SESSION["no"]],["no_hidangan",strip_tags($no)],["status_buat",0]])->lockForUpdate()
          ->update(["jml_item"=>DB::raw("jml_item+1")]);
        }
        foreach ($ceks as $cek);
        if($cek->sts==0){
          order::where("no_pemesanan",$_SESSION["no"])->lockForUpdate()->update(["status_bayar"=>1]);
        }
        DB::commit();
      } catch (Exception $e) {
        DB::rollback();
      }
      if($_SESSION["statusbayar"]==0){
        $_SESSION["statusbayar"]=1;
      }
      return $this->load_keranjang();
    }

    public function save_qty($notrans,$val){
      DB::beginTransaction();
      try {
        transaction::where([["no_pemesanan",$_SESSION["no"]],["no_transaksi",$notrans]])->lockForUpdate()
                    ->update(["jml_item"=>$val]);
        DB::commit();
      } catch (Exception $e) {
        DB::rollback();
      }
    }

    public function get_catatan($notrans){
      $datas = transaction::select("catatan","no_transaksi")
                  ->where([["no_pemesanan",$_SESSION["no"]],["no_transaksi",strip_tags($notrans)]])->sharedLock()
                  ->get();
      return view("pelanggan.operation.set-catatan",compact("datas"));
    }

    public function save_note(Request $req,$notran){
      DB::beginTransaction();
      try {
        if($req->catatan!=""){
          transaction::where("no_transaksi",$notran)->lockForUpdate()
          ->update(["catatan"=>$req->catatan]);
        }else{
          session()->flash('title','Pembritahuan');
          session()->flash('type','info');
          session()->flash('message','Kolom catatan masih kosong');
        }
        DB::commit();
      } catch (Exception $e) {
        DB::rollback();
      }
    }

    public function delete_transaction($notrans,$baris){
      DB::beginTransaction();
      try {
        transaction::where([["no_pemesanan",$_SESSION["no"]],["no_transaksi",$notrans]])
                    ->whereIn("status_buat",[0,4])->lockForUpdate()
                    ->delete();
        DB::commit();
        if($baris == 1){
          order::where("no_pemesanan",$_SESSION["no"])->update(["status_bayar"=>0]);
          $_SESSION["statusbayar"]=0;
        }
      } catch (Exception $e) {
        DB::rollback();
      }
      return $this->load_keranjang();
    }

    public function load_keranjang(){
      $datas = transaction::select("no_transaksi as notrans",
                        "nama_hidangan as nama",
                        "harga","status_buat as sts","jml_item as jml","status_buat as sts")
                      ->join("foods","foods.no_hidangan","=","transactions.no_hidangan")
                      ->where("no_pemesanan","=",DB::raw("(SELECT no_pemesanan FROM orders WHERE no_pemesanan = $_SESSION[no] AND status_bayar = 1)"))->get();
      return view('pelanggan.operation.tabel-order',compact(["datas","statusbayar"]));
    }

    public function order_pesanan(){
      DB::beginTransaction();
      try {
        $affected = transaction::where([["no_pemesanan",$_SESSION["no"]],["status_buat",0]])->lockForUpdate()
                     ->update(["status_buat"=>1]);
        DB::commit();
        if($affected==0){
          session()->flash('title','Pembritahuan');
          session()->flash('type','info');
          session()->flash('message','Tidak ada hidangan yang dapat dipesan');
        }
      } catch (Exception $e) {
        DB::rollback();
      }
      return $this->load_keranjang();
    }

    public function bayar_pesanan(){
      DB::beginTransaction();
      try {
        order::where("no_pemesanan",$_SESSION["no"])->lockForUpdate()
              ->update(["status_bayar"=>2]);
        $nomors = order::select("no_pemesanan as no")->orderBy("no_pemesanan","desc")->limit(1)->sharedLock()->get();
        foreach ($nomors as $nomor);
        $_SESSION["no"]=$nomor->no + 1;
        order::insert(["no_pemesanan"=>$_SESSION["no"],"no_meja"=>$_SESSION["nomeja"],"tanggal"=>new DateTime]);
        DB::commit();
        session()->flash('title','Berhasil');
        session()->flash('type','success');
        session()->flash('message','Proses permintaan pembayaran berhasil, pelayan kami akan mengunjungi anda, terima kasih telah menikmati hidangan kami');
      } catch (Exception $e) {
        session()->flash('title','Gagal');
        session()->flash('type','error');
        session()->flash('message','Mohon maaf, proses pembayaran anda gagal, coba kembali atau panggil pelayan kami');
        DB::rollback();
      }
      return $this->load_keranjang();
    }

    public function logout(Request $req){
      $login = employee::select("NIP","password")->where([["NIP",strip_tags($req->nip)],["status",1]])->get();
      foreach ($login as $data);
      if(($data->NIP==strip_tags($req->nip))&&(Hash::check(strip_tags($req->password),$data->password))){
        unset($_SESSION["jabatan"]);
        return redirect('/logout');
      }else{
        session()->flash('title','Gagal');
        session()->flash('type','error');
        session()->flash('message','NIP atau password salah');
        DB::rollback();
      }
    }

    public function simpan_feedback(Request $req){
      $ceks = feedback::select("no_pemesanan as no")->where("no_pemesanan",($_SESSION["no"]-1))->get();
      if(count($ceks)<=0){
        foreach ($ceks as $cek);
        if($req->feedback!=""){
          DB::beginTransaction();
          try {
            feedback::insert(["no_pemesanan"=>($_SESSION["no"]-1),"tanggal"=>new DateTime,"perihal"=>strip_tags($req->perihal),"konten"=>strip_tags($req->feedback)]);
            DB::commit();
          } catch (Exception $e) {
            DB::rollback();
          }
        }
      }
    }
}
