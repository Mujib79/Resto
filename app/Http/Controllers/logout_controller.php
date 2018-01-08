<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();

class logout_controller extends Controller
{
    public function index(){
      session_destroy();
      return view("logout");
    }
}
