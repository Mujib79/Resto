<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();

use Illuminate\Http\Request;
use App\order;
use App\transaction;
use Illuminate\Support\Facades\DB;
date_default_timezone_set('Asia/Jakarta');

class kasir_controller extends Controller
{
  public function __construct(){
      $this->middleware("kasir:$_SESSION[jabatan]");
  }

  public function index(){
    return view("kasir/index");
  }

  public function get_bayar(){
    $datas = order::select("orders.no_pemesanan as no","no_meja","total")
            ->join("view_jum_bayar","view_jum_bayar.no_pemesanan","=","orders.no_pemesanan")
            ->where("status_bayar",2)
            ->get();
    return view("kasir.operation.daftar-bayar",compact("datas"));
  }

  public function get_detail_pesan($no){
    $datas = transaction::select("jml_item as qty","nama_hidangan as nama","harga")
            ->join("foods","foods.no_hidangan","=","transactions.no_hidangan")
            ->where("no_pemesanan",$no)->get();
    return view("kasir.operation.detail-pesanan",compact("datas"));
  }

  public function simpan_transaksi($nopesan){
    DB::begintransaction();
    try {
      order::where("no_pemesanan",$nopesan)->update(["status_bayar"=>3]);
      DB::commit();
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Transaksi berhasil disimpan');
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','error');
      session()->flash('type','error');
      session()->flash('message','Transaksi Gagal disimpan');
    }
  }
}
