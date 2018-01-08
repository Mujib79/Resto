@extends('layout.parent-layout')

@section('title')
  Koki
@endsection

@section('lib')
  <link rel="stylesheet" href="{!!asset('public/css/koki.css')!!}">
  <script type="text/javascript" src="{!!asset('public/js/koki.js')!!}"></script>
  <link rel="stylesheet" href="{!!asset('public/css/croppie.css')!!}" />
  <script src="{!!asset('public/js/croppie.js')!!}"></script>
@endsection

@section('popup')
  <div id="popupBox">
    <div id="cropping" class="wrapper">
      <div class="head">
        <fieldset>
          <div><label>Pemotongan</label></div>
          <button type="button" class="close animasi" onclick="close_popup()">X</button>
        </fieldset>
      </div>
      <center>
        <div class="wrappop">
          <img id="imgcrop">
        </div>
          <button type="button" style="margin-top:1px;" class="green animasi" name="Tetapkan" id="Tetapkan">Tetapkan</button>
      </center>
    </div>
    {{-- popup kedua --}}
    <div id="databahanbaku" class="wrapper">
      <div class="head">
        <fieldset>
          <div><label>Bahan Baku</label></div>
          <button type="button" class="close animasi" onclick="popup('databahanbaku',0)">X</button>
        </fieldset>
      </div>
      <center>
        <div class="panel-cari"><table width= 100%><tr><td>Cari Bahan Baku<td>:<td><input type="text" onkeyup="search_data(this,'t_databahan')" placeholder="Cari Data Bahan Baku"
              title="Mencari bahan baku"/></table></div>
        <div id="tampil-data" class="wrappop">

        </div>
      </center>
    </div>
    {{-- popup ketiga --}}
    <div id="editbahanbaku" class="wrapper">
      <div class="head">
        <fieldset>
          <div><label>Edit Bahan Baku</label></div>
          <button type="button" style="right:-7px" class="close animasi" onclick="popup('editbahanbaku',0)">X</button>
        </fieldset>
      </div>
      <div id="edit-data" class="wrappop">
        <label for="namabahan">Ubah Nama:</label>
        <input class="animasi" type="text" name="namabahan" id="namabahan">
        <input type="hidden" name="tempnobahan" id="tempnobahan">
      </div>
      <center>
        <button type="button" id="simpanubahing" onclick="edit_data(document.getElementById('tempnobahan').value,1)" class="green save prosesbtn animasi" name="button">Simpan</button>
      </center>
    </div>
    {{-- popup keempat --}}
    <div id="addbahanbaku" class="wrapper">
      <div class="head">
        <fieldset>
          <div><label>Tambah Bahan Baku</label></div>
          <button type="button" style="right:-7px" class="close animasi" onclick="popup('addbahanbaku',0)">X</button>
        </fieldset>
      </div>
      <div id="add-data" class="wrappop">
        <label for="addnamabahan">Nama Bahan Baku:</label>
        <input class="animasi" type="text" name="addnamabahan" id="addnamabahan">
      </div>
      <center>
        <button type="button" id="simpanadding" onclick="add_new(1)" class="green save prosesbtn animasi" name="button">Simpan</button>
      </center>
    </div>

    {{-- popup kelima --}}
    <div id="popcatatan" class="wrapper">
      <div class="head">
        <fieldset>
          <div><label>Catatan</label></div>
          <button type="button" class="close animasi" onclick="popup('popcatatan',0)">X</button>
        </fieldset>
      </div>
      <center>
        <div id="tampil-catatan" class="wrappop">

        </div>
      </center>
    </div>
  </div>
@endsection

@section('child')
  <ul class="list-button">
    <li class="active firstmenu" id="f1" onclick="sort_data('dashboard');change_color('#f1',0)"><a class="dashboard animasi" href="#">Dashboard</a></li>
    <li class="firstmenu" id="f2" onclick="sort_data('dapur');change_color('#f2',0)"><a class="kitchen animasi" href="#">Mode Dapur</a></li>
    <li class="firstmenu" id="f3" onclick="tampil_child('#first-child1','')"><a id="firsta1" class="dish animasi" href="#">Olah Hidangan</a></li>
    <li>
      <ul id="first-child1">
        <li><a id="a1" class="plus" href="#" onclick="tampil_child('#second-child1','#a1')">Tampilkan Hidangan</a></li>
        <li>
          <ul id="second-child1">
            <li onclick="sort_data('ALL')" id="ALL"><a onclick="change_color('#ALL',1);change_color('#f3',0)" class="allfood" href="#">Semua</a></li>
            <li onclick="sort_data('APP')" id="APP"><a onclick="change_color('#APP',1);change_color('#f3',0)" class="app" href="#">Hidangan Pembuka</a></li>
            <li onclick="sort_data('MAC')" id="MAC"><a onclick="change_color('#MAC',1);change_color('#f3',0)" class="mac" href="#">Hidangan Utama</a></li>
            <li onclick="sort_data('DES')" id="DES"><a onclick="change_color('#DES',1);change_color('#f3',0)" class="des" href="#">Hidangan Penutup</a></li>
            <li onclick="sort_data('SOF')" id="SOF"><a onclick="change_color('#SOF',1);change_color('#f3',0)" class="sof" href="#">Minuman</a></li>
          </ul>
        </li>
        <li><a id="a2" class="plus" href="#" onclick="tampil_child('#second-child2','#a2')">Olah Data Hidangan</a></li>
        <li>
          <ul id="second-child2">
            <li id="new" onclick="add_new(0)"><a onclick="change_color('#new',1);change_color('#f3',0)" class="new" href="#">Tambah Hidangan Baru</a></li>
            <li onclick="sort_data('trash')" id="trash"><a onclick="change_color('#trash',1);change_color('#f3',0)" class="trash" href="#">Sampah Hidangan</a></li>
          </ul>
        </li>
        <li><a id="a3" class="plus" href="#" onclick="tampil_child('#second-child3','#a3')">Olah Ketersediaan Hidangan</a></li>
        <li>
          <ul id="second-child3">
            <li onclick="sort_data('available')" id="available"><a onclick="change_color('#available',1);change_color('#f3',0)" class="available" href="#">Tersedia</a></li>
            <li onclick="sort_data('notavailable')" id="notavailable"><a onclick="change_color('#notavailable',1);change_color('#f3',0)" class="notavailable" href="#">Tidak Tersedia</a></li>
          </ul>
        </li>
        <li><a id="a4" class="plus" href="#" onclick="tampil_child('#second-child4','#a4')">Olah Bahan Baku</a></li>
        <li>
          <ul id="second-child4">
            <li onclick="sort_data('shing')" id="shing"><a onclick="change_color('#shing',1);change_color('#f3',0)" class="basket" href="#">Lihat Bahan Baku</a></li>
            <li id="newing" onclick="popup('addbahanbaku',1)"><a class="new" href="#">Tambah Bahan Baku Baru</a></li>
            <li onclick="sort_data('trashing')" id="trashing"><a onclick="change_color('#trashing',1);change_color('#f3',0)" class="trash" href="#">Sampah Bahan Baku</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
  <input type="hidden" id="tempfirstid" value="#f1">
  <input type="hidden" id="tempid" value="#">
@endsection

@section('content')
  @include('koki.operation.dashboard')
@endsection
