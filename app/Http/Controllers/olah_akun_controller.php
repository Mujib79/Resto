<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();
use Illuminate\Http\Request;
use App\employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Storage;


class olah_akun_controller extends Controller
{
     public function __construct(){
         $this->middleware("admin:$_SESSION[jabatan]");
     }

     public function index(){
        $datas = employee::select("nip","nama","jabatan","kelamin","masuk","telepon","alamat")
                 ->where("nip",$_SESSION["nip"])->get();
        if(file_exists("storage/app/public/foto/".$_SESSION["nip"].'.jpeg')){
         $url = asset("storage/app/public/foto/".$_SESSION["nip"].'.jpeg'.'?'.Storage::lastModified('public/foto/'.$_SESSION["nip"].'.jpeg'));
         $_SESSION["icon"] = asset("storage/app/public/foto/".$_SESSION["nip"].'.jpeg'.'?'.Storage::lastModified('public/foto/'.$_SESSION["nip"].'.jpeg'));
        }else{
         $url = asset("public/gambar/notfound.png");
         foreach ($datas as $data);
         switch ($data->jabatan) {
           case 'KOKI':
           if($data->kelamin == "P"){
             $_SESSION["icon"] = asset("public/gambar/icon/cheff_pria.png");
           }else{
             $_SESSION["icon"] = asset("public/gambar/icon/cheff_wanita.png");
           }
           break;
           case 'MANAGER':
           if($data->kelamin == "P"){
             $_SESSION["icon"] = asset("public/gambar/icon/manager_pria.png");
           }else{
             $_SESSION["icon"] = asset("public/gambar/icon/manager_wanita.png");
           }
           break;
           case 'PELAYAN':
           if($data->kelamin == "P"){
             $_SESSION["icon"] = asset("public/gambar/icon/pelayan_pria.png");
           }else{
             $_SESSION["icon"] = asset("public/gambar/icon/pelayan_wanita.png");
           }
           break;
           case 'KASIR':
           if($data->kelamin == "P"){
             $_SESSION["icon"] = asset("public/gambar/icon/kasir_pria.png");
           }else{
             $_SESSION["icon"] = asset("public/gambar/icon/kasir_wanita.png");
           }
           break;
         }
        }
        return view("olah_akun/index",compact(["datas","url"]));
     }

     public function show($id){
       switch ($id) {
         case 'data-diri':
           $datas = employee::select("nip","nama","jabatan","kelamin","masuk","telepon","alamat")
           ->where("nip",$_SESSION["nip"])->get();
           if(file_exists("storage/app/public/foto/".$_SESSION["nip"].'.jpeg')){
             $url = asset("storage/app/public/foto/".$_SESSION["nip"].'.jpeg'.'?'.Storage::lastModified('public/foto/'.$_SESSION["nip"].'.jpeg'));
           }else{
             $url = asset("public/gambar/notfound.png");
           }
          return view("olah_akun.operation.data-diri",compact(["datas","url"]));
         break;
         case 'ganti':
          return view("olah_akun/operation/ganti-password");
         break;
       }
     }

     function update_pegawai(Request $req){
       DB::beginTransaction();
       try {
        employee::where("nip",strip_tags($req->nip))
                  ->update(["nama"=>strip_tags($req->nama),
                    "kelamin"=>strip_tags($req->kelamin),
                    "telepon"=>strip_tags($req->telepon),
                    "alamat"=>strip_tags($req->alamat)]);
        DB::commit();
        if($req->tempimg!=1){
          if($req->tempimg!=""){
            $data = $req->tempimg;
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            file_put_contents("storage/app/public/foto/".$req->nip.'.jpeg', $data);
          }else{
            Storage::delete('public/foto/'.$req->nip.'.jpeg');
          }
        }
        session()->flash('title','Berhasil');
        session()->flash('type','success');
        session()->flash('message','Data berhasil disimpan');
      }catch(Exception $e) {
        DB::rollback();
        session()->flash('title','Gagal');
        session()->flash('type','error');
        session()->flash('message','Data Gagal disimpan');
      }
     }

     public function update_password(Request $req){
       $datas = employee::select("password")
                ->where("nip",$_SESSION["nip"])
                ->get();
       foreach ($datas as $data);
       if(Hash::check($req->plama,$data->password)){
         $hashpass = Hash::make($req->pbaru);
         employee::where("nip",$_SESSION["nip"])
            ->update(["password"=>$hashpass]);
          session()->flash('title','Berhasil');
          session()->flash('type','success');
          session()->flash('message','Password berhasil diubah');
       }else{
         session()->flash('title','Gagal');
         session()->flash('type','error');
         session()->flash('message','Password lama salah');
       }
       return view("olah_akun.operation.ganti-password");
     }
}
