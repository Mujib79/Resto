<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();

use Illuminate\Http\Request;
use App\employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class index_controller extends Controller
{
    public function index(){
      if(isset($_SESSION["jabatan"])){
        switch ($_SESSION["jabatan"]) {
          case 'KOKI':
            return redirect("/koki");
          break;
          case 'PANTRY':
            return redirect("/pantry");
          break;
          case 'MANAGER':
            return redirect("/manager");
          break;
          case 'KASIR':
            return redirect("/kasir");
          break;
          case 'PELANGGAN':
            return redirect("/pelanggan");
          break;
        }
      }else{
        return view("index");
      }
    }

    public function store(Request $request){
      if($request->masukakun){
        $user = $request->username;
        $pass = $request->password;
      }else{
        $user = $request->user;
        $pass = $request->pass;
      }
      $login = employee::select("NIP","password","jabatan","nama","kelamin")->where([["NIP",$user],["status",1]])->get();
      foreach ($login as $key => $data);
      if((($data->NIP==$user)&&(Hash::check($pass,$data->password)))&&(count($data->NIP)!=0)){
        $_SESSION["nip"] = $user;
        $_SESSION["nama"] = $data->nama;
        if(file_exists("storage/app/public/foto/".$_SESSION["nip"].'.jpeg')){
         $_SESSION["icon"] = asset("storage/app/public/foto/".$_SESSION["nip"].'.jpeg'.'?'.Storage::lastModified('public/foto/'.$_SESSION["nip"].'.jpeg'));
        }else{
         switch ($data->jabatan) {
           case 'KOKI':
             if($data->kelamin == "P"){
               $_SESSION["icon"] = asset("public/gambar/icon/cheff_pria.png");
             }else{
               $_SESSION["icon"] = asset("public/gambar/icon/cheff_wanita.png");
          }
           break;
           case 'PANTRY':
              $_SESSION["icon"] = asset("public/gambar/icon/pantry.png");
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
        if($request->masukakun){
          return redirect('/olah-akun');
        }else{
          $_SESSION["jabatan"] = $data->jabatan;
          switch ($data->jabatan) {
            case 'MANAGER':return redirect('/manager');break;
            case 'KOKI':return redirect('/koki');break;
            case 'PANTRY':return redirect('/pantry');break;
            case 'KASIR':return redirect('/kasir');break;
            case 'CS':return redirect('/customer-service');break;
          }
        }
      }else{
        $error = 1;
        return view("index", compact("error"));
      }
    }

    public function set_table_number($nomeja){
      $nomeja = strip_tags($nomeja);
      if($nomeja!=""){
        $_SESSION["nomeja"] = $nomeja;
        $_SESSION["jabatan"] = "PELANGGAN";
        return redirect("/pelanggan");
      }
    }

}
