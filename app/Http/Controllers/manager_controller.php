<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();

use Illuminate\Http\Request;
use App\employee;
use App\feedback;
use App\shopping_report;
use App\shopping_detail;
use Illuminate\Support\Facades\DB;
use DateTime;
date_default_timezone_set('Asia/Jakarta');
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;

class manager_controller extends Controller
{
  public function index(){
      $datas = DB::table('view_pemasukan_harian')
               ->select(DB::raw("DATE_FORMAT(tanggal,'%m') as tanggal,YEAR(tanggal) as tahun, total"))
               ->where(DB::raw("YEAR(tanggal)"),DB::raw("YEAR(CURDATE())"))
               ->groupBy("tanggal")->get();

       $years = DB::table("view_pemasukan_harian")
                ->select(DB::raw("YEAR(tanggal) as tahun"))
                ->groupBy(DB::raw("YEAR(tanggal)"))->get();
    return view("manager/index",compact(["datas","years"]));
  }

  public function backup_pengeluaran($noreport){
    $reports = shopping_report::select("shopping_reports.no_report","budget","tanggal","belanja","nama")
           ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
           ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
           ->where("shopping_reports.no_report",$noreport)
           ->get();
    $datas = shopping_detail::select("no_detail","ingredients.no_bahan","nama_bahan","satuan","jumlah","shopping_details.keterangan")
                    ->leftjoin("ingredients","ingredients.no_bahan","=","shopping_details.no_bahan")
                    ->where("no_report",$noreport)->get();
    $pdf = PDF::loadView('manager.operation.backup-belanja',compact(["datas","reports"]));
    // sleep(10);
    if(count($datas)>0){
      return $pdf->download("Laporan belanja nomor ".$noreport.'.pdf');
    }
  }

  public function backup($sts,$tahun,$bulan){
    switch ($sts) {
      case 'harian':
        $datas = DB::table('view_pemasukan_harian')
          ->select(DB::raw("DATE_FORMAT(tanggal,'%d-%m-%Y') as tanggal,total"))
          ->where([[DB::raw("MONTH(tanggal)"),intval($bulan)],
          [DB::raw("YEAR(tanggal)"),$tahun]])
          ->groupBy("tanggal")->get();
          $namefile = "Harian($bulan-$tahun)";
          switch ($bulan) {
            case '01': $bulan = "Januari";break;
            case '02': $bulan = "Februari";break;
            case '03': $bulan = "Maret";break;
            case '04': $bulan = "April";break;
            case '05': $bulan = "Mei";break;
            case '06': $bulan = "Juni";break;
            case '07': $bulan = "Juli";break;
            case '08': $bulan = "Agustus";break;
            case '09': $bulan = "September";break;
            case '10': $bulan = "Oktober";break;
            case '11': $bulan = "November";break;
            case '12': $bulan = "Desember";break;
          }
          $pesan = "Pada Bulan $bulan Tahun $tahun";
      break;
      case 'bulanan':
        $datas = DB::table('view_pemasukan_harian')
                 ->select(DB::raw("DATE_FORMAT(tanggal,'%m-%Y') as tanggal,SUM(total) as total"))
                 ->where(DB::raw("YEAR(tanggal)"),$tahun)
                 ->groupBy(DB::raw("MONTH(tanggal)"))
                 ->get();
        $namefile = "Bulanan($tahun)";
        $pesan = "Pada Tahun $tahun";
      break;
      case 'tahunan':
        $datas = DB::table('view_pemasukan_harian')
        ->select(DB::raw("DATE_FORMAT(tanggal,'%Y') as tanggal,SUM(total) as total"))
        ->groupBy(DB::raw("YEAR(tanggal)"))
        ->get();
        $namefile = "Tahunan";
      break;
    }
    $pdf = PDF::loadView('manager.operation.backup',compact(["datas","sts","pesan"]));
    if(count($datas)>0){
      return $pdf->download($namefile.'.pdf');
    }
  }

  public function add_employee(Request $req,$rows){
    $year = date("y");
    $datas = employee::select("NIP")->where("jabatan",strip_tags($req->jabatan))
             ->orderBy("NIP","desc")->limit(1)->get();
    if(count($datas)>0){
      foreach ($datas as $data);
      $nomor = intval(substr($data->NIP,3)) + 1;
      $length = strlen($nomor);
      switch($length){
        case 1: $nomor = "00".$nomor;break;
        case 2: $nomor = "0".$nomor;break;
      }
    }else{
      $nomor = "001";
    }
    switch (strip_tags($req->jabatan)) {
      case 'KOKI': $NIP = "2".$year.$nomor;break;
      case 'PANTRY': $NIP = "3".$year.$nomor;break;
      case 'KASIR': $NIP = "4".$year.$nomor;break;
      case 'PRAMUSAJI': $NIP = "5".$year.$nomor;break;
    }
    DB::begintransaction();
    try {
      $hashpass = Hash::make("admin");
      employee::insert(["NIP"=>$NIP,"nama"=>strip_tags($req->nama),
                "jabatan"=>strip_tags($req->jabatan),
                "kelamin"=>strip_tags($req->kelamin),
                "password"=>$hashpass,
                "masuk"=>new DateTime]);
      DB::commit();
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data pegawai berhasil disimpan');
    } catch (Exception $e) {
      DB::rollback();
    }
    if($rows==0){
      return $this->show("olah-pegawai");
    }else{
      $datas = employee::select("NIP","nama","jabatan","masuk")->where([['jabatan',"<>","MANAGER"],["status",1]])->get();
      return view("manager.operation.tabel-pegawai",compact("datas"));
    }
  }

  public function edit_employee($nip){
    $datas = employee::select("NIP","nama","jabatan","kelamin","masuk","telepon","alamat")
            ->where("NIP",strip_tags($nip))->get();
    if(file_exists('public/storage/foto/'.$nip.'.jpeg')){
      $url = "public".Storage::url('public/foto/'.$nip.'.jpeg').'?'.Storage::lastModified('public/foto/'.$nip.'.jpeg');
    }else{
      $url = asset("public/gambar/notfound.png");
    }
    return view("manager.operation.edit-pegawai",compact(["datas","url"]));
  }

  public function update_employee(Request $req,$nip){
    DB::begintransaction();
    try {
      employee::where("NIP",strip_tags($nip))->lockForUpdate()
                ->update(["NIP"=>strip_tags($req->nip),
                  "nama"=>strip_tags($req->nama),"jabatan"=>strip_tags($req->jabatan),
                  "kelamin"=>strip_tags($req->kelamin),"telepon"=>strip_tags($req->telepon),
                  "alamat"=>strip_tags($req->alamatpegawai)]);
      DB::commit();
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data pegawai berhasil diubah');
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data pegawai gagal diubah');
    }
    return $this->edit_employee($nip);
  }

    public function delete_employee($nip){
        DB::begintransaction();
    try {
      employee::where("NIP",strip_tags($nip))->update(["status"=>0]);
      DB::commit();
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data pegawai berhasil dihapus');
      $datas = employee::select("NIP","nama","jabatan","masuk")->where([['jabatan',"<>","MANAGER"],["status",1]])->get();
    } catch (Exception $e) {
      DB::rollback();
    }
    if(count($datas)>0){
      return view("manager.operation.tabel-pegawai",compact("datas"));
    }else{
      return $this->show('olah-pegawai');
    }
  }

  public function detail_report($noreport){
    $reports = shopping_report::select("no_report","budget","tanggal",DB::raw("(SELECT SUM(satuan*jumlah) FROM shopping_details WHERE no_report= $noreport) as total"))->where("no_report",$noreport)->get();
    $datas = shopping_detail::select("no_detail","ingredients.no_bahan","nama_bahan","satuan","jumlah","shopping_details.keterangan")
                    ->leftjoin("ingredients","ingredients.no_bahan","=","shopping_details.no_bahan")
                    ->where("no_report",$noreport)->get();
    return view("manager.operation.detail-laporan",compact(["reports","datas"]));
  }

  public function sort_by($month,$year){
    if($month!="def"){
      $datas = DB::table('view_pemasukan_harian')->where([[DB::raw("MONTH(tanggal)"),$month],
               [DB::raw("YEAR(tanggal)"),$year]])->get();
    }else{
      $datas = DB::table('view_pemasukan_harian')
               ->select(DB::raw("DATE_FORMAT(tanggal,'%Y-%m') as tanggal,SUM(total) as total"))
               ->where(DB::raw("YEAR(tanggal)"),$year)
               ->groupBy(DB::raw("MONTH(tanggal)"))
               ->get();
    }
    return view("manager.operation.tabel-pemasukan",compact("datas"));
  }

  public function restore_report($noreport){
    DB::begintransaction();
    try {
      shopping_report::where("no_report",strip_tags($noreport))
            ->lockForUpdate()->update(["status"=>2]);
      DB::commit();
      $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
             ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
             ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
             ->where("shopping_reports.status",3)
             ->get();
      $pesan = "Tidak ada sampah laporan belanja bahan baku";
    } catch (Exception $e) {
      DB::rollback();
    }
    return view("manager.operation.tabel-pengeluaran",compact(["datas","pesan"]));
  }

  public function delete_report($noreport){
    DB::begintransaction();
    try {
      shopping_report::where("no_report",strip_tags($noreport))->lockForUpdate()
              ->update(["status"=>3]);
      DB::commit();
      $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
             ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
             ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
             ->where("shopping_reports.status",2)
             ->get();
      $status = 1;
      $pesan = "Belum ada laporan belanja bahan baku";
    } catch (Exception $e) {
      DB::rollback();
    }
    return view("manager.operation.tabel-pengeluaran",compact(["datas","status","pesan"]));
  }

  public function delete_report_permanent($noreport){
    DB::begintransaction();
    try {
      shopping_report::where("no_report",strip_tags($noreport))->lockForUpdate()
              ->delete();
      DB::commit();
      $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
             ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
             ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
             ->where("shopping_reports.status",3)
             ->get();
      $pesan = "Tidak ada sampah laporan belanja bahan baku";
    } catch (Exception $e) {
      DB::rollback();
    }
    return view("manager.operation.tabel-pengeluaran",compact(["datas","pesan"]));
  }

  public function next_shopping_report($limit){
    DB::begintransaction();
    try {
      $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
             ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
             ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
             ->where("shopping_reports.status",2)
             ->skip($limit)->take(15)
             ->get();
      $status = 1;
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
    }
    return view("manager.operation.tabel-pengeluaran",compact(["datas","status"]));
  }

  public function next_feedback($limit){
    DB::begintransaction();
    try {
      $datas = feedback::skip($limit)->take(15)->get();
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
    }
    return view("manager.operation.tabel-feedback",compact("datas"));
  }

  public function show($id){
    switch ($id) {
      case 'dashboard':
      $datas = DB::table('view_pemasukan_harian')
               ->select(DB::raw("DATE_FORMAT(tanggal,'%m') as tanggal,YEAR(tanggal) as tahun, total"))
               ->where(DB::raw("YEAR(tanggal)"),DB::raw("YEAR(CURDATE())"))
               ->groupBy("tanggal")->get();

       $years = DB::table("view_pemasukan_harian")
                ->select(DB::raw("YEAR(tanggal) as tahun"))
                ->groupBy(DB::raw("YEAR(tanggal)"))->get();
        return view("manager.operation.dashboard", compact(["datas","years"]));
      break;
      case 'olah-pegawai':
        $datas = employee::select("NIP","nama","jabatan","masuk")->where([['jabatan',"<>","MANAGER"],["status",1]])->get();
        $pesan = "Tidak ada data pegawai";
        return view("manager.operation.olah-data-pegawai",compact(["datas","pesan"]));
      break;
      case 'harian':
        $datas = DB::table('view_pemasukan_harian')
                 ->select(DB::raw("DATE_FORMAT(tanggal,'%d-%m-%Y') as tanggal,total"))
                 ->where([[DB::raw("MONTH(tanggal)"),DB::raw("MONTH(CURDATE())")],
                 [DB::raw("YEAR(tanggal)"),DB::raw("YEAR(CURDATE())")]])
                 ->groupBy("tanggal")->get();
        $pesan = "Belum ada pemasukan harian untuk bulan ini";
        $years = DB::table("view_pemasukan_harian")
                 ->select(DB::raw("YEAR(tanggal) as tahun"))
                 ->groupBy(DB::raw("YEAR(tanggal)"))->get();
        return view("manager.operation.show",compact(["datas","pesan","id","years"]));
      break;
      case 'bulanan':
        $datas = DB::table('view_pemasukan_harian')
                 ->select(DB::raw("DATE_FORMAT(tanggal,'%m-%Y') as tanggal,SUM(total) as total"))
                 ->where(DB::raw("YEAR(tanggal)"),DB::raw("YEAR(CURDATE())"))
                 ->groupBy(DB::raw("MONTH(tanggal)"))
                 ->get();
        $pesan = "Belum ada pemasukan bulanan untuk tahun ini";
        $years = DB::table("view_pemasukan_harian")
                 ->select(DB::raw("YEAR(tanggal) as tahun"))
                 ->groupBy(DB::raw("YEAR(tanggal)"))->get();
        return view("manager.operation.show",compact(["datas","pesan","id","years"]));
      break;
      case 'tahunan':
        $datas = DB::table('view_pemasukan_harian')
        ->select(DB::raw("DATE_FORMAT(tanggal,'%Y') as tanggal,SUM(total) as total"))
        ->groupBy(DB::raw("YEAR(tanggal)"))
        ->get();
        $pesan = "Belum ada pemasukan tahunan";
        return view("manager.operation.show",compact(["datas","pesan","id"]));
      break;
      case 'pengeluaran':
        $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
               ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
               ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
               ->where("shopping_reports.status",2)
               ->limit(15)
               ->get();
        $counts = shopping_report::select(DB::raw("count(*) as jum"))->get();
        $status = 1;
        $pesan = "Belum ada laporan belanja bahan baku";
        return view("manager.operation.show-report",compact(["datas","pesan","id","status","counts"]));
      break;
      case 'trash':
        $datas = shopping_report::select("shopping_reports.no_report","budget","tanggal","updated_at as update","belanja","nama")
               ->leftjoin("view_jum_belanja","shopping_reports.no_report","=","view_jum_belanja.no_report")
               ->leftjoin("employees","shopping_reports.nip","=","employees.nip")
               ->where("shopping_reports.status",3)
               ->get();
        $pesan = "Tidak ada sampah laporan belanja bahan baku";
        return view("manager.operation.show-report",compact(["datas","pesan","id"]));
      break;
      case 'feedback':
        $datas = feedback::limit(15)->get();
        $pesan = "Tidak ada umpan balik dari pelanggan";
        $counts = feedback::select(DB::raw("count(*) as jum"))->get();
        return view("manager.operation.show-feedback",compact(["datas","pesan","id","counts"]));
      break;
    }
  }

  public function delete_row_feedback(Request $req){
    DB::begintransaction();
    try {
      $i=1;
      while($req["tempinp".$i]){
        feedback::where("no_pemesanan",$req["tempinp".$i])->lockForUpdate()->delete();
        DB::commit();
        $i++;
      }
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Umpan balik berhasil dihapus');
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Umpan balik gagal dihapus');
    }
    return $this->show('feedback');
  }

  public function showChart($tahun){
      $datas = DB::table('view_pemasukan_harian')
               ->select(DB::raw("DATE_FORMAT(tanggal,'%m') as tanggal,YEAR(tanggal) as tahun, total"))
               ->where(DB::raw("YEAR(tanggal)"),"$tahun")
               ->groupBy("tanggal")->get();
      return view("manager.operation.showChart",compact("datas"));
  }
}
