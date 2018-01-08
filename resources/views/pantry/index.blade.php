@extends('layout.parent-layout')

@section('title')
  Pantry
@endsection

@section('lib')
  <link rel="stylesheet" href="{!!asset('public/css/pantry.css')!!}">
  <script type="text/javascript" src="{!!asset('public/js/pantry.js')!!}"></script>
  <link rel="stylesheet" href="{!!asset('public/css/jquery-ui.css')!!}">
  <script src="{!!asset('public/js/jquery-ui.js')!!}"></script>
@endsection

@section('child')
  <ul class="list-button">
    <li class="firstmenu active" id="f1" onclick="show('olah-bahan-baku');change_color('#f1',0)"><a class="basket_ing animasi" href="#">Olah Bahan Baku</a></li>
    <li class="firstmenu" id="f2" onclick="tampil_child('#first-child1','');"><a class="dish animasi" href="#">Olah Ketersediaan Hidangan</a></li>
    <li>
      <ul id="first-child1">
        <li onclick="show('all')" id="all"><a onclick="change_color('#f2',0);change_color('#all',1)" class="allfood firstchildmenu" href="#">Semua Hidangan</a></li>
        <li onclick="show('available')" id="available"><a onclick="change_color('#f2',0);change_color('#available',1)" class="available firstchildmenu" href="#">Tersedia</a></li>
        <li onclick="show('notavailable')" id="notavailable"><a onclick="change_color('#f2',0);change_color('#notavailable',1)" class="notavailable firstchildmenu" href="#">Tidak Tersedia</a></li>
      </ul>
    </li>
    <li class="firstmenu" id="f3" onclick="tampil_child('#first-child2','');"><a class="note animasi" href="#">Olah Laporan Belanja</a></li>
    <li>
      <ul id="first-child2">
        <li onclick="show('olah-laporan-belanja');change_color('#f3',0);change_color('#alllap',1)" id="alllap"><a class="all-data firstchildmenu" href="#">Semua Laporan</a></li>
        <li onclick="show('trash');change_color('#f3',0);change_color('#trash',1)" id="trash"><a class="blacktrash firstchildmenu" href="#">Sampah Laporan</a></li>
      </ul>
    </li>
  </ul>
  <input type="hidden" id="tempfirstid" value="#f1">
  <input type="hidden" id="tempid" value="#">
@endsection

@section('content')
  @include('pantry.operation.olah-bahan-baku')
@endsection
