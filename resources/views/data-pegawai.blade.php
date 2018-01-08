<html>
	<head>
		<title>MyResto | Olah Akun</title>
	</head>
	<script src="/js/jquery.js"></script>
	<script src="/js/prosesakun.js"></script>
	<script src="/js/public.js"></script>
	<link rel="stylesheet" href="/css/olahakun.css" type="text/css">
  <link rel="stylesheet" href="/css/public.css">
	<link rel="stylesheet" href="/css/sweetalert.css" type="text/css">
	<script type="text/javascript" async="" src="/js/sweetalert.min.js"></script>
	<body>
		<header>
			<aside>
				<label class="judul">My Resto</label>
			</aside>
			<aside>
				<input class="brick sign animasi" id="out" onclick="log_out()" name="out" type="button" value="Log out">
			</aside>
		</header>
		<form method="post">
      {{csrf_field()}}
			<aside class="content">
				<fieldset>
					<legend>Data Pegawai</legend>
					<div class="form">
						<table width = 100%>
							<tr><td>NIP*<td>:<td><div><input type="text" name="nip" placeholder="NIP Anda" value="{{$data->NIP}}" readonly/></div>
							<tr><td>Nama*<td>:<td><div><input type="text" id="nama" name="nama" maxlength="30" placeholder="Nama Anda" value="{{$data->nama}}"/></div>
							<tr><td>Jabatan*<td>:<td><div><input type="text" id="jabatan" method="POST" name="jabatan" value="{{$data->jabatan}}" placeholder="Jabatan Anda" readonly>
							</div>
							<tr><td>Kelamin*<td>:<td><div><span class="radio"><input type="radio" onclick="checktemp('P')" id="P" name="kelamin" value="P"/><span id="pria">Pria</span>
											  <input type="radio" id="W" name="kelamin" onclick="checktemp('W')" value="W"/><span id="wanita">Wanita</span></span>
							</div>
							<tr><td>Telepon<td>:<td><div><input type="text" id="telepon" name="telepon" maxlength="13" placeholder="Nomor Telepon" onkeyup="return validasi(this)" value="{{$data->telepon}}"/></div>
							<tr><td>Alamat<td>:<td><div><textarea id="alamat" name="alamat" placeholder="Alamat Anda" value=""></textarea></div>
						</table>
						<input class="green animasi" type="button" onclick="simpan_data()" id="simpan" name="simpan" value="Simpan"/>
						<input class="red animasi" type="button" onclick="batalkanproses()" id="batal" name="batal" value="Batal"/>
						<script>
							document.getElementById("{{$data->kelamin}}").checked = true;
							document.getElementById('alamat').value = "{{$data->alamat}}";
						</script>
					</div>
					<div class="formsandi">
						<div class="panelubah">
							<legend>Form Ubah Sandi</legend>
							<table>
								<tr><td width = 20%>Sandi Lama<td>:<td><input type="password" id="sandilama" name="sandilama" placeholder="Sandi lama">
								<tr><td>Sandi Baru<td>:<td><input type="password" id="sandibaru" name="sandibaru" placeholder="Sandi baru">
								<tr><td>Konfirmasi Sandi Baru<td>:<td><input type="password" id="konfbaru" name="konfbaru" placeholder="Tulis Ulang Sandi baru">
							</table>
							<input class="green animasi" type="button" onclick="ubahsandi()" id="ubah" name="ubah" value="Ubah"/>
							<input class="red animasi" type="button" onclick="batalkanproses()" id="batalkan" name="batal" value="Batal"/>
						</div>
					</div>
					<input type="hidden" id="temp">
				</fieldset>
			</aside>
			<footer class="footer">
			</footer>
		</form>
	</body>
	@if (session()->has('message'))
		<script>
			window.onload = function(){
				swal({
					title: "{{session()->get('title')}}",
					text: "{{session()->get('message')}}",
					type: "{{session()->get('type')}}",
					confirmButtonColor: "#2b5dcd",
					confirmButtonText: "OK",
					closeOnConfirm: true
				});
			};
		</script>
	@endif
</html>
