@extends('layout.parent-layout')

@section('title')
	Olah akun
@endsection

@section('lib')
  <link rel="stylesheet" href="{!!asset('public/css/olahakun.css')!!}">
  <script type="text/javascript" src="{!!asset('public/js/olah_akun.js')!!}"></script>
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
	</div>
@endsection

@section('child')
	<ul class="list-button">
		<li class="active firstmenu" id="f1" onclick="show_data('data-diri');change_color('#f1',0)"><a class="personaldata animasi" href="#">Data Diri</a></li>
		<li class="firstmenu" id="f2" onclick="show_data('ganti');change_color('#f2',0)"><a class="password animasi" href="#">Ganti Password</a></li>
	</ul>
	<input type="hidden" id="tempfirstid" value="#f1">
@endsection

@section('content')
  @include('olah_akun.operation.data-diri')
@endsection
