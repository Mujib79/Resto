<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();

use Illuminate\Http\Request;
use App\ingredient;
use App\ingredient_detail;
use App\food;
use App\shopping_report;
use App\shopping_detail;
use Illuminate\Support\Facades\DB;
use DateTime;
date_default_timezone_set('Asia/Jakarta');

class pantry_controller extends Controller
{
  public function __construct(){
      $this->middleware("pantry:$_SESSION[jabatan]");
  }

  public function index(){
    $datas = ingredient::select("ingredients.no_bahan as no","nama_bahan as nama","view_jumlah_bahan.jumlah","view_jumlah_bahan.jum","view_jumlah_bahan.kadaluarsa","ingredients.keterangan as ket")
             ->leftjoin("view_jumlah_bahan","ingredients.no_bahan","=","view_jumlah_bahan.no_bahan")
             ->where("status",1)->get();
    $nowdate = date("Y-m-d");
    return view("pantry/index",compact(["datas","nowdate"]));
  }

  public function edit_data_laporan($id){
    $reports = shopping_report::select("no_report","budget","tanggal","NIP")->where("no_report",$id)->get();
    $datas = shopping_detail::select("no_detail","ingredients.no_bahan","nama_bahan","satuan","jumlah","shopping_details.keterangan")
                    ->leftjoin("ingredients","ingredients.no_bahan","=","shopping_details.no_bahan")
                    ->where("no_report",$id)->get();
    foreach ($reports as $report);
    if($report->NIP == $_SESSION["nip"]){
      return view("pantry.operation.edit-laporan",compact(["reports","datas"]));
    }else{
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Anda tidak memiliki hak untuk mengedit laporan ini');
      return $this->show('olah-laporan-belanja');
    }
  }

  public function add_new_report($sts){
    $noreportobj = shopping_report::select("no_report as no")->orderBy("no_report","desc")->limit(1)->get();
    if(count($noreportobj)>0){
      foreach ($noreportobj as $noreport);
      $nomor = $noreport->no + 1;
    }else{
      $nomor=1;
    }
    DB::beginTransaction();
    try {
      shopping_report::insert(["no_report"=>$nomor,"NIP"=>$_SESSION["nip"],"tanggal"=>new DateTime]);
      DB::commit();
      $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
               ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
               ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
               ->where("shopping_reports.status",1)
               ->get();
      $status = 1;
    } catch (Exception $e) {
      DB::rollback();
    }
    if($sts==1){
      return view("pantry.operation.tabel-report",compact(["datas","status"]));
    }else{
      return view("pantry.operation.olah-laporan-belanja",compact(["datas","status"]));
    }
  }

  public function save_information($nodetail,$noreport,$ket){
    DB::beginTransaction();
    try {
      shopping_detail::where([["no_detail",strip_tags($nodetail)],["no_report",strip_tags($noreport)]])
            ->update(["keterangan"=>strip_tags($ket)]);
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
    }

  }

  public function update_detail_laporan($sts,$noreport,$nodetail,$val){
    DB::beginTransaction();
    try {
      switch ($sts) {
        case 0:
          $no = ingredient::select("no_bahan")->where("nama_bahan","=","$val")->get();
          if(count($no)>0){
            foreach ($no as $nobahan);
            shopping_detail::where([["no_report",strip_tags($noreport)],
                  ["no_detail",strip_tags($nodetail)]])
                  ->update(["no_bahan"=>$nobahan->no_bahan]);
            DB::commit();
          }else{
            session()->flash('title','Gagal');
            session()->flash('type','error');
            session()->flash('message','Data bahan baku tidak ditemukan');
          }
          $reports = shopping_report::select("no_report")->where("no_report",$noreport)->get();
          $datas = shopping_detail::select("no_detail","ingredients.no_bahan","nama_bahan","satuan","jumlah")
          ->leftjoin("ingredients","ingredients.no_bahan","=","shopping_details.no_bahan")
          ->where("no_report",$noreport)->get();
          return view("pantry.operation.tabel-detail-laporan",compact("datas","reports"));
        break;
        case 1:
          shopping_detail::where([["no_report",strip_tags($noreport)],
                  ["no_detail",strip_tags($nodetail)]])->update(["satuan"=>$val]);
        break;
        case 2:
          shopping_detail::where([["no_report",strip_tags($noreport)],
                  ["no_detail",strip_tags($nodetail)]])->update(["jumlah"=>$val]);
        break;
      }
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
    }
  }

  public function restore_laporan($id){
    DB::beginTransaction();
    try {
      shopping_report::where("no_report",$id)->update(["status"=>1]);
      $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","belanja","nama")
               ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
               ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
               ->where("shopping_reports.status",0)
               ->get();
      DB::commit();
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data laporan berhasil dikembalikan');
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data laporan gagal dikembalikan');
    }
    if(count($datas)>0){
      return view("pantry.operation.tabel-report",compact("datas"));
    }else{
      return $this->show('trash');
    }
  }

  public function hapus_laporan_belanja($id,$status,$jumrow){
    $gagal=0;
    DB::beginTransaction();
    try {
      if($status==1){
        $ceks = shopping_report::select("NIP")->where("no_report",$id)->get();
        foreach ($ceks as $cek);
        if($cek->NIP==$_SESSION["nip"]){
          shopping_report::where("no_report",$id)->update(["status"=>0]);
          session()->flash('title','Berhasil');
          session()->flash('type','success');
          session()->flash('message','Data laporan berhasil dihapus');
        }else{
          $gagal=1;
          session()->flash('title','Gagal');
          session()->flash('type','error');
          session()->flash('message','Anda tidak memiliki hak untuk menghapus laporan ini');
        }
      }else{
        shopping_report::where("no_report",$id)->delete();
        session()->flash('title','Berhasil');
        session()->flash('type','success');
        session()->flash('message','Data laporan berhasil dihapus');
      }
    DB::commit();
      $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","belanja","nama")
               ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
               ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
               ->where("shopping_reports.status",$status)
               ->get();
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data laporan gagal dihapus');
    }
    if($jumrow>1){
      return view("pantry.operation.tabel-report",compact(["datas","status"]));
    }else{
      if($status==1){
        return $this->show('olah-laporan-belanja');
      }else{
        return $this->show('trash');
      }
    }
  }

  public function send_to_manager($no,$sts){
    $ceks = shopping_report::select("NIP")->where("no_report",$no)->get();
    foreach ($ceks as $cek);
    DB::beginTransaction();
    if($cek->NIP==$_SESSION["nip"]){
      try {
        shopping_report::where("no_report",strip_tags($no))->lockForUpdate()
          ->update(["status"=>2]);
        DB::commit();
        session()->flash('title','Berhasil');
        session()->flash('type','success');
        session()->flash('message','Data laporan berhasil dikirim');
      } catch (Exception $e) {
        DB::rollback();
        session()->flash('title','Gagal');
        session()->flash('type','error');
        session()->flash('message','Data laporan gagal dikirim');
      }
    }else{
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Anda tidak memiliki hak untuk mengirim laporan ini');
    }
    if($sts==1){
      $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","belanja","nama")
      ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
      ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
      ->where("shopping_reports.status",1)
      ->get();
      $status = 1;
      return view("pantry.operation.tabel-report",compact(["datas","status"]));
    }else{
      return $this->show("olah-laporan-belanja");
    }
  }

  public function cari_bahan_baku($val){
    $datalists = ingredient::select("nama_bahan as nama")
                 ->where("nama_bahan","like","%$val%")->limit(5)->get();
    return view("pantry.operation.datalists",compact("datalists"));
  }

  public function cari_dengan_bahan_baku($val,$sts){
    if($sts!=2){
      $datas_tbl = food::select("foods.no_hidangan as no","nama_hidangan as nama","foods.status")
              ->join("recipes","foods.no_hidangan","=","recipes.no_hidangan")
              ->join("ingredients","recipes.no_bahan","=","ingredients.no_bahan")
              ->where([["life_cycle",1],["nama_bahan","like","%$val%"],["foods.status",$sts]])->get();
    }else {
      $datas_tbl = food::select("foods.no_hidangan as no","nama_hidangan as nama","foods.status")
              ->join("recipes","foods.no_hidangan","=","recipes.no_hidangan")
              ->join("ingredients","recipes.no_bahan","=","ingredients.no_bahan")
              ->where([["life_cycle",1],["nama_bahan","like","%$val%"]])->get();
    }
    return view("pantry.operation.tabel-cari",compact("datas_tbl"));
  }

  public function show($id){
    switch ($id) {
      case 'olah-bahan-baku':
        $datas = ingredient::select("ingredients.no_bahan as no","nama_bahan as nama","view_jumlah_bahan.jumlah","view_jumlah_bahan.jum","view_jumlah_bahan.kadaluarsa","ingredients.keterangan as ket")
                 ->leftjoin("view_jumlah_bahan","ingredients.no_bahan","=","view_jumlah_bahan.no_bahan")
                 ->where("status",1)->get();
        $nowdate = date("Y-m-d");
        return view("pantry.operation.olah-bahan-baku",compact(["datas","nowdate"]));
      break;
      case 'olah-laporan-belanja':
        $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
                 ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
                 ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
                 ->where("shopping_reports.status",1)
                 ->get();
        $pesan = "Tidak ada laporan belanja bahan baku";
        $status = 1;
        return view("pantry.operation.olah-laporan-belanja",compact(["datas","pesan","status"]));
      break;
      case 'trash':
        $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
                 ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
                 ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
                 ->where("shopping_reports.status",0)
                 ->get();
        $pesan = "Tidak ada sampah laporan belanja bahan baku";
        return view("pantry.operation.olah-laporan-belanja",compact(["datas","pesan"]));
      break;
      case 'all':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","status")
                ->where("life_cycle",1)->get();
        $status = 1;
        $pesan = "Data Hidangan Tidak Tersedia";
        return view("pantry.operation.show-hidangan",compact(["datas","status","pesan"]));
      break;
      case 'available':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","status")
                ->where([["life_cycle",1],["status",1]])->get();
        $status = 2;
        $pesan = "Semua Hidangan Tidak Tersedia";
        return view("pantry.operation.show-hidangan",compact(["datas","status","pesan"]));
      break;
      case 'notavailable':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","status")
                ->where([["life_cycle",1],["status",0]])->get();
        $status = 3;
        $pesan = "Semua Hidangan Tersedia";
        return view("pantry.operation.show-hidangan",compact(["datas","status","pesan"]));
      break;
    }
  }

  public function update_ketersediaan(Request $req,$sts,$visibility){
    $i=1;
    DB::beginTransaction();
    do {
      try {
        food::where("no_hidangan",$req["tempinp".$i++])->update(["status"=>$sts]);
        DB::commit();
        session()->flash('title','Berhasil');
        session()->flash('type','success');
        session()->flash('message','Status ketersediaan diubah');
      } catch (Exception $e) {
        DB::rollback();
        session()->flash('title','Gagal');
        session()->flash('type','error');
        session()->flash('message','Status ketersediaan gagal diubah');
      }
    } while ($req["tempinp".$i]);
    return $this->show($visibility);
  }

  public function save_data($id,$no,$noreg,$val){
    DB::begintransaction();
    try {
      switch ($id) {
        case 'tgl_beli':
          ingredient_detail::where([["no_bahan",strip_tags($no)],["no_reg",strip_tags($noreg)]])
                            ->update(["tgl_beli"=>strip_tags($val)]);
        break;
        case 'tgl_produksi':
          ingredient_detail::where([["no_bahan",strip_tags($no)],["no_reg",strip_tags($noreg)]])
                            ->update(["tgl_produksi"=>strip_tags($val)]);
        break;
        case 'tgl_kadaluarsa':
          ingredient_detail::where([["no_bahan",strip_tags($no)],["no_reg",strip_tags($noreg)]])
                            ->update(["tgl_kadaluarsa"=>strip_tags($val)]);
        break;
        case 'jumlah':
          ingredient_detail::where([["no_bahan",strip_tags($no)],["no_reg",strip_tags($noreg)]])
                            ->update(["jumlah"=>strip_tags($val)]);
        break;
        case 'keterangan':
          ingredient_detail::where([["no_bahan",strip_tags($no)],["no_reg",strip_tags($noreg)]])
                            ->update(["keterangan"=>strip_tags($val)]);
        break;
        case 'satuan' :
          ingredient::where("no_bahan",$no)->update(["keterangan"=>strip_tags($val)]);
        break;
      }
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
    }
  }

  public function tambah_baris_detail($no,$sts){
    DB::begintransaction();
    try {
      switch ($sts) {
        case 0:
          $noregs = ingredient_detail::select("no_reg")->where("no_bahan",strip_tags($no))
                    ->orderBy("no_reg","desc")->limit(1)->get();
          if(count($noregs)>0){
            foreach($noregs as $noreg);
            $nomor = $noreg->no_reg+1;
          }else{
            $nomor = 1;
          }
          ingredient_detail::insert(["no_bahan"=>$no,"no_reg"=>$nomor]);
          DB::commit();
          $details = ingredient_detail::select("no_reg as no","tgl_beli","tgl_produksi","tgl_kadaluarsa","jumlah","keterangan as ket")
          ->where("no_bahan",strip_tags($no))->get();
          return view("pantry.operation.tabel-detail-bahan",compact(["details","no"]));
        break;
        case 1:
          $nodetails = shopping_detail::select("no_detail")->where("no_report",strip_tags($no))
                      ->orderBy("no_detail","desc")->limit(1)->get();
          if(count($nodetails)>0){
            foreach($nodetails as $nodetail);
            $nomor = $nodetail->no_detail+1;
          }else{
            $nomor = 1;
          }
          shopping_detail::insert(["no_report"=>strip_tags($no),"no_detail"=>$nomor]);
          DB::commit();
          $datas = shopping_detail::select("no_detail","ingredients.no_bahan","nama_bahan","satuan","jumlah","shopping_details.keterangan")
          ->leftjoin("ingredients","ingredients.no_bahan","=","shopping_details.no_bahan")
          ->where("no_report",strip_tags($no))->get();
          return view("pantry.operation.tabel-detail-laporan",compact("datas","no"));
        break;
      }
    } catch (Exception $e) {
      DB::rollback();
    }
  }

  public function hapus_baris_detail(Request $req,$no,$sts){
    DB::begintransaction();
    try {
      $i = 1;
      switch ($sts) {
        case 0:
          while($req["tempinp$i"]){
            ingredient_detail::where([["no_bahan",$no],["no_reg",$req["tempinp$i"]]])
            ->delete();
            $i++;
          }
          DB::commit();
          $details = ingredient_detail::select("no_reg as no","tgl_beli","tgl_produksi","tgl_kadaluarsa","jumlah","keterangan as ket")
          ->where("no_bahan",strip_tags($no))->get();
          return view("pantry.operation.tabel-detail-bahan",compact(["details","no"]));
        break;
        case 1:
          while($req["tempinp$i"]){
            shopping_detail::where([["no_report",$no],["no_detail",$req["tempinp$i"]]])
            ->delete();
            $i++;
          }
          DB::commit();
          $datas = shopping_detail::select("no_detail","ingredients.no_bahan","nama_bahan","satuan","jumlah","shopping_details.keterangan")
          ->leftjoin("ingredients","ingredients.no_bahan","=","shopping_details.no_bahan")
          ->where("no_report",strip_tags($no))->get();
          return view("pantry.operation.tabel-detail-laporan",compact("datas","no"));
        break;
      }
    } catch (Exception $e) {
      DB::rollback();
    }
  }

  public function edit_show($no){
    $ings = ingredient::select("no_bahan as no","nama_bahan as nama","keterangan as satuan")
            ->where("no_bahan",$no)->get();
    $details = ingredient_detail::select("no_reg as no","tgl_beli","tgl_produksi","tgl_kadaluarsa","jumlah","keterangan as ket")
            ->where("no_bahan",$no)->get();
    return view("pantry.operation.edit-bahan-baku",compact(["ings","details"]));
  }

  public function update_budget($id,$val){
    DB::beginTransaction();
    try {
      shopping_report::where("no_report",$id)->update(["budget"=>strip_tags($val)]);
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
    }

  }
}
