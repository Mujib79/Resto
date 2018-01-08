<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();

use App\food;
use App\ingredient;
use App\ingredient_detail;
use App\recipe;
use App\order;
use App\transaction;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

date_default_timezone_set('Asia/Jakarta');
class koki_controller extends Controller
{

  public function __construct(){
      $this->middleware("koki:$_SESSION[jabatan]");
  }

  public function index(){
      return view("koki/index");
  }

  public function status_buat($sts,$nopesan,$notrans){
    DB::beginTransaction();
    try {
      transaction::where("no_transaksi",strip_tags($notrans))->lockForUpdate()
      ->update(["status_buat"=>$sts]);
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
    }
    return $this->show_detail_order($nopesan);
  }

  public function show_detail_order($no){
    $datas = transaction::select('no_pemesanan as nopesan','no_transaksi as notrans',
            'catatan','foods.no_hidangan as nohid',
            'nama_hidangan as nama','jml_item as jml','status_buat as sts')
      ->join('foods','transactions.no_hidangan','=','foods.no_hidangan')
      ->where('no_pemesanan',$no)->whereIn('status_buat',[1,2])->get();
    return view('koki/operation/show_detail_order',compact('datas'));
  }

  public function show_order(){
    $datas = order::select('orders.no_pemesanan as nopesan','no_meja',DB::raw("(select sum(jml_item) FROM transactions b where b.no_pemesanan = orders.no_pemesanan AND status_buat in (1,2)) as jum"))
      ->where('status_bayar','=', 1)->sharedLock()->get();
    return view("koki/operation/show-order",compact("datas"));
  }

  public function get_bahan_baku(){
    $datas = ingredient::select("no_bahan","nama_bahan")->get();
    return view("koki/operation/show_bahan_baku",compact("datas"));
  }

  public function food($id){
    switch ($id) {
      case 'ALL':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama",
        "kode_tipe as kode","harga","life_cycle")->where("life_cycle",1)->get();
      break;
    }
    $status = 1;
    return view("koki/operation/show",compact(["datas","status","id"]));
  }

  public function new_data_ingredient($nama,$temp){
    DB::beginTransaction();
    try {
      $datas = ingredient::select(DB::raw("(SELECT no_bahan FROM ingredients ORDER BY no_bahan DESC LIMIT 1) as no"))->get();
      foreach ($datas as $data);
      ingredient::insert(["no_bahan"=>($data->no+1),"nama_bahan"=>$nama]);
      ingredient_detail::insert(["no_bahan"=>($data->no+1),"no_reg"=>1]);
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data berhasil disimpan');
      DB::commit();
    } catch (Exception $e) {
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal disimpan');
      DB::rollback();
    }
    return $this->show($temp);
  }

  public function new_data(){
    return view('koki/operation/add-new');
  }

  public function add_food(Request $request){
    DB::beginTransaction();
    try{
      $nomors = food::select("no_hidangan as no")->orderBy("no_hidangan","desc")->limit(1)->get();
      if(count($nomors)>0){
        foreach ($nomors as $nomor);
        $no = $nomor->no+1;
      }else{
        $no = 1;
      }
      food::insert([
        "no_hidangan"=>$no,
        "NIP"=>$_SESSION["nip"],
        "nama_hidangan"=>strip_tags($request->nama_hidangan),
        "kode_tipe"=>strip_tags($request->jenis),
        "harga"=>strip_tags($request->harga),
        "komposisi"=>strip_tags($request->komposisi),
        "cara_buat"=>strip_tags($request->cara_buat),
        "status"=>$request->ketersediaan,
        "created_at"=>new DateTime
      ]);
      if($request->tempimg!=1){
        if($request->tempimg!=""){
          $data = $request->tempimg;
          list($type, $data) = explode(';', $data);
          list(, $data)      = explode(',', $data);
          $data = base64_decode($data);
          file_put_contents("storage/app/public/gambar/".$no.'.jpeg', $data);
          //compress image
          $f = finfo_open();
          $mime_type = finfo_buffer($f, $data, FILEINFO_MIME_TYPE);
          list($width, $height) = getimagesizefromstring($data);
          $new_width = $width * 0.5;
          if($new_width>300){
            $new_height = $height * 0.5;
            $image_p = imagecreatetruecolor($new_width, $new_height);
            switch (strtolower($mime_type)) {
              case 'image/png':$image = imagecreatefrompng("storage/app/public/gambar/".$no.'.jpeg');break;
              case 'image/jpg':$image = imagecreatefromjpeg("storage/app/public/gambar/".$no.'.jpeg');break;
              case 'image/jpeg':$image = imagecreatefromjpeg("storage/app/public/gambar/".$no.'.jpeg');break;
              case 'image/gif':$image = imagecreatefromgif("storage/app/public/gambar/".$no.'.jpeg');break;
            }
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_p,"storage/app/public/gambar/".$no.'.jpeg',80);
          }
        }else{
          if(Storage::delete('public/gambar/'.$no.'.jpeg'));
        }
      }
      // simpan ke resep
      $i = 0;
      while($request["no".$i]){
        recipe::insert(["no_bahan"=>$request["no".$i],
        "no_hidangan"=>$no,
        "jumlah"=>$request["jum".$i],
        "keterangan"=>$request["ket".$i]]);
        $i++;
      }
      echo "
        <script>
          change_color('#$request->jenis',1);
        </script>
      ";
      DB::commit();
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data berhasil ditambahkan');
    }catch(ErrorException $e){
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal ditambahkan');
    }
    Cache::flush();
    return $this->show($request->jenis);
  }

  public function update_ketersediaan(Request $req,$sts,$visibility){
    $i=1;
    DB::beginTransaction();
    do {
      try {
        food::where("no_hidangan",$req["cek".$i++])->update(["status"=>$sts]);
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
    } while ($req["cek".$i]);
    return $this->show($visibility);
  }

  public function update(Request $request,$id){
    DB::beginTransaction();
    try{
      food::where("no_hidangan",$request->no)
      ->update(["nama_hidangan"=>strip_tags($request->nama_hidangan),
      "kode_tipe"=>$request->jenis,"harga"=>strip_tags($request->harga),
      "komposisi"=>strip_tags($request->komposisi),
      "cara_buat"=>strip_tags($request->cara_buat)]);
      if($request->tempimg!=1){
        if($request->tempimg!=""){
          $data = $request->tempimg;
          list($type, $data) = explode(';', $data);
          list(, $data)      = explode(',', $data);
          $data = base64_decode($data);
          file_put_contents("storage/app/public/gambar/".$request->no.'.jpeg', $data);

          $f = finfo_open();
          $mime_type = finfo_buffer($f, $data, FILEINFO_MIME_TYPE);
          list($width, $height) = getimagesizefromstring($data);
          $new_width = $width * 0.5;
          if($new_width>300){
            $new_height = $height * 0.5;
            $image_p = imagecreatetruecolor($new_width, $new_height);
            switch (strtolower($mime_type)) {
              case 'image/png':$image = imagecreatefrompng("storage/app/public/gambar/".$request->no.'.jpeg');break;
              case 'image/jpg':$image = imagecreatefromjpeg("storage/app/public/gambar/".$request->no.'.jpeg');break;
              case 'image/jpeg':$image = imagecreatefromjpeg("storage/app/public/gambar/".$request->no.'.jpeg');break;
              case 'image/gif':$image = imagecreatefromgif("storage/app/public/gambar/".$request->no.'.jpeg');break;
            }
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_p,"storage/app/public/gambar/".$request->no.'.jpeg',80);
          }
        }else{
          if(Storage::delete('public/gambar/'.$request->no.'.jpeg'));
        }
      }
      // simpan ke resep
      $i = 0;
      recipe::where("no_hidangan",$request->no)->delete();
      while($request["no".$i]){
        recipe::insert(["no_bahan"=>$request["no".$i],
        "no_hidangan"=>$request->no,
        "jumlah"=>$request["jum".$i],
        "keterangan"=>strip_tags($request["ket".$i])]);
        $i++;
      }
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data berhasil diubah');
      DB::commit();
    }catch(ErrorException $e){
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal diubah');
    }
    Cache::flush();
    return $this->edit($id);
  }

  public function update_ingredient($id,$nama){
    DB::beginTransaction();
    try {
      ingredient::where("no_bahan",$id)->update(["nama_bahan"=>strip_tags($nama)]);
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data berhasil diubah');
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal diubah');
    }
    Cache::flush();
    return $this->show('shing');
  }

  public function edit($id){
    $datas = food::select("no_hidangan","nama_hidangan",
                "kode_tipe","harga","komposisi","cara_buat","created_at","updated_at","nama")
            ->join("employees", 'foods.NIP', '=', 'employees.NIP')
            ->where("no_hidangan",$id)
            ->get();
    $recipes = recipe::select("recipes.no_bahan","nama_bahan","recipes.jumlah","recipes.keterangan")
              ->join("ingredients", 'recipes.no_bahan', '=', 'ingredients.no_bahan')
              ->where("no_hidangan",$id)
              ->get();
    if(file_exists("storage/app/public/gambar/".$id.'.jpeg')){
      $url = asset(Storage::url('app/public/gambar/'.$id.'.jpeg').'?'.Storage::lastModified('public/gambar/'.$id.'.jpeg'));
    }else{
      $url = asset("public/gambar/notfound.png");
    }
    return view('koki/operation/edit',compact("datas","recipes","url"));
  }

  public function delete_ingredient($id,$kode){
    DB::beginTransaction();
    try {
      ingredient::where('no_bahan',$id)->update(["status"=>0]);
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data dipindahkan ke sampah');
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal dihapus');
    }
    return $this->show($kode);
  }

  public function delete_dish($id,$kode){
    DB::beginTransaction();
    try {
      food::where('no_hidangan',$id)->update(["life_cycle"=>0]);
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data dipindahkan ke sampah');
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal dihapus');
    }
    return $this->show($kode);
  }

  public function permanent_del_ing($id){
    DB::beginTransaction();
    try {
      ingredient::where('no_bahan',$id)->delete();
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data berhasil dihapus');
      DB::commit();

    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal dihapus');
    }
    return $this->show("trashing");
  }

  public function permanent($id){
    DB::beginTransaction();
    try {
      food::where('no_hidangan',$id)->delete();
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data berhasil dihapus');
      DB::commit();
      if(file_exists("storage/app/public/gambar/".$id.'.jpeg')){
        if(Storage::delete('public/gambar/'.$id.'.jpeg'));
      }
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal dihapus');
    }
    return $this->show("trash");
  }

  public function restore_ingredient($id){
    DB::beginTransaction();
    try {
      ingredient::where("no_bahan",$id)->update(["status"=>1]);
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data berhasil dikembalikan');
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal dikembalikan');
    }
    return $this->show("trashing");
  }

  public function restore_food($id){
    DB::beginTransaction();
    try {
      food::where('no_hidangan',$id)->update(["life_cycle"=>1]);
      session()->flash('title','Berhasil');
      session()->flash('type','success');
      session()->flash('message','Data berhasil dikembalikan');
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      session()->flash('title','Gagal');
      session()->flash('type','error');
      session()->flash('message','Data gagal dikembalikan');
    }
    return $this->show("trash");
  }

  public function show($id){
    switch ($id) {
      case 'ALL':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama",
            "kode_tipe as kode","harga","life_cycle")
                    ->orderBy("nama_hidangan","asc")
            ->where("life_cycle","=",1)->get();
        $status = 1;
        $pesan = "Tidak ada hidangan !";
      break;
      case 'APP':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","harga","life_cycle")
                ->orderBy("nama_hidangan","asc")
                ->where([["kode_tipe","APP"],["life_cycle",1]])
                ->get();
        $status = 1;
        $pesan = "Tidak ada hidangan pembuka !";
      break;
      case 'DES':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","harga","life_cycle")
                ->orderBy("nama_hidangan","asc")
                ->where([["kode_tipe","DES"],["life_cycle",1]])
                ->get();
        $status = 1;
        $pesan = "Tidak ada hidangan penutup !";
      break;
      case 'MAC':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","harga","life_cycle")
                ->orderBy("nama_hidangan","asc")
                ->where([["kode_tipe","MAC"],["life_cycle",1]])
                ->get();
        $status = 1;
        $pesan = "Tidak ada hidangan utama !";
      break;
      case 'SOF':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","harga","life_cycle")
                ->orderBy("nama_hidangan","asc")
                ->where([["kode_tipe","SOF"],["life_cycle",1]])
                ->get();
        $status = 1;
        $pesan = "Tidak ada minuman !";
      break;
      case 'available':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","kode_tipe as kode","harga","life_cycle")
                ->orderBy("nama_hidangan","asc")
                ->where([["status",1],["life_cycle",1]])
                ->get();
        $pesan = "Tidak ada hidangan yang dapat dibuat !";
        $confmessage = "Tidak ";
        $novisib = 0;
        $visib = "available";
        $status = 2;
      break;
      case 'notavailable':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","kode_tipe as kode","harga","life_cycle")
                ->orderBy("nama_hidangan","asc")
                ->where([["status",0],["life_cycle",1]])
                ->get();
        $status = 2;
        $novisib = 1;
        $visib = "notavailable";
        $pesan = "Seluruh hidangan tidak tersedia !";
      break;
      case 'trash':
        $datas = food::select("no_hidangan as no","nama_hidangan as nama","kode_tipe as kode","harga","life_cycle")
                  ->orderBy("nama_hidangan","asc")
                  ->where("life_cycle",0)->get();
        $pesan = "Tidak ada sampah hidangan !";
        $status = 0;
      break;
      case 'shing':
        $datas = ingredient::select("ingredients.no_bahan","nama_bahan","jumlah","ingredients.keterangan")
                 ->leftjoin("view_jumlah_bahan","ingredients.no_bahan","=","view_jumlah_bahan.no_bahan")
                 ->orderBy("nama_bahan","asc")
                 ->where("status",1)->get();
        $pesan = "Tidak ada bahan baku!";
        $status = 3;
      break;
      case 'trashing':
        $datas = ingredient::select("ingredients.no_bahan","nama_bahan","jumlah","ingredients.keterangan")
                 ->leftjoin("view_jumlah_bahan","ingredients.no_bahan","=","view_jumlah_bahan.no_bahan")
                 ->orderBy("nama_bahan","asc")
                 ->where("status",0)->get();
        $pesan = "Tidak ada sampah bahan baku!";
        $status = 4;
      break;
      case 'dapur':
        return view("koki/operation/dapur");
      break;
      case 'dashboard':
        return view("koki/operation/dashboard");
      break;
    }
    return view("koki/operation/show",compact(["datas","status","pesan","confmessage","visib","novisib","id"]));
  }
}
