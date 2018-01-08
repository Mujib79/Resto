<?php

namespace App\Http\Controllers;
error_reporting(E_ALL & ~E_NOTICE);
session_start();
use Illuminate\Http\Request;
use App\employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Connection;

class data_pegawai_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!isset($_SESSION["nip"])){
        return redirect("/");
      }else{
        $employee = employee::where("NIP",$_SESSION["nip"])->get();
        foreach ($employee as $key => $data);
        return view("/data-pegawai",compact("data"));
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      DB::beginTransaction();
      if($request->simpan){
          try {
            employee::where("NIP",$_SESSION["nip"])->update(["nama"=>strtoupper($request->nama),
                "kelamin"=>$request->kelamin,"alamat"=>strtoupper($request->alamat),
                "telepon"=>$request->telepon]);
            DB::commit();
            session()->flash('title','Berhasil');
            session()->flash('type','success');
            session()->flash('message','Data anda berhasil diubah');
            return redirect("data-pegawai");
          } catch (Exception $e) {
            DB::rollback();
            session()->flash('title','Gagal');
            session()->flash('type','error');
            session()->flash('message','Data anda gagal diubah');
            return redirect("data-pegawai");
          }
      }else{
        try{
          $employee = employee::select("password")->where("NIP",$_SESSION["nip"])->get();
          foreach ($employee as $key => $data);
          if(Hash::check($request->sandilama,$data->password)){
            $hashpass = Hash::make($request->sandibaru);
            employee::where("NIP",$_SESSION["nip"])->update(["password"=>$hashpass]);
            DB::commit();
            session()->flash('title','Berhasil');
            session()->flash('type','success');
            session()->flash('message','Password berhasil diubah');
            return redirect("data-pegawai");
          }else{
            DB::rollback();
            session()->flash('title','Gagal');
            session()->flash('type','error');
            session()->flash('message','Password gagal diubah');
            return redirect("data-pegawai");
          }
        }catch(Exception $e){
          DB::rollback();
          session()->flash('title','Gagal');
          session()->flash('type','error');
          session()->flash('message',$e);
          return redirect("data-pegawai");
        }
      }
    }
}
