<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();

class operation_controller extends Controller
{
    public function notfound(){
      return view("notfound");
    }

    public function logout(){
      if($_SESSION['jabatan']=="PELANGGAN"){
        return redirect('/pelanggan');
      }else{
        session_destroy();
        return view("logout");
      }
    }
}
