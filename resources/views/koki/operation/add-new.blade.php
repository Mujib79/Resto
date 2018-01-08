<div class="panel-header">
  <button type="button" class="green save prosesbtn animasi" id="simpan" onclick="add_food()" name="button">Simpan</button>
</div>
<form id="serialdata" method="post" role="form" enctype="multipart/form-data">
  {{-- <button type="submit" name="button">Simpan</button> --}}
  <div class="panel-header">
    <label for="judul">*Nama Hidangan:</label>
    <textarea id="judul" placeholder="Ketikkan disini" class="judul_dish animasi" onkeyup="generate_info()" onkeydown="if(event.keyCode==13)return false" oninput="autoheight()" name="nama_hidangan"></textarea>
  </div>
  <hr>
  <div class="content-edit">
    <div class="image-config">
      <div id="info" class="image-option info">
        <b><span  style="color:yellow">Tambahkan Gambar:</span></b>
      </div>
      <div id="image-edit" class="image-edit">
        <img src="public/gambar/notfound.png" name="img" id="img">
      </div>
      <div class="image-option">
        <button id="unggah" type="button" onclick="browse()" class="brick blackupload prosesbtn animasi" name="button">UNGGAH</button>
        <input id="mask-browse" class="mask-browse" name="maskbrowse" onchange="ValidateSingleInput(this)" type="file">
        <button id="delete-image" type="button" onclick="delete_image()" class="green1 blacktrash prosesbtn animasi" name="button" disabled>HAPUS</button>
        <input id="path" class="animasi" type="text" readonly>
      </div>
    </div>
    <div class="form-isian" enctype="multipart/form-data">
      <fieldset class="form-dish">
        <label for="jenis">*Jenis Hidangan:</label>
        <select id="jenis" class="animasi" name="jenis">
          <option value="new" selected="selected">Pilih Jenis</option>
          <option value="APP">Hidangan Pembuka</option>
          <option value="MAC">Hidangan Utama</option>
          <option value="DES">Hidangan Penutup</option>
          <option value="SOF">Minuman</option>
        </select>
        <label for="harga">*Harga Hidangan:</label>
        <input id="harga" class="animasi" type="number" onkeyup="validasi(event,this)" step="1000" min=0 placeholder="Rp.0" name="harga" value="">
        *Ketersediaan Hidangan:
        <div id="rad">
          <input type="radio" id="kosong" name="ketersediaan" value="0" checked><label for="kosong">Belum Tersedia</label>
          <input type="radio" id="tersedia" name="ketersediaan" value="1"><label for="tersedia">Tersedia</label>
        </div>
        <label for="komposisi">Komposisi:</label>
        <textarea id="komposisi" name="komposisi" class="animasi" placeholder="Ketikkan disini"></textarea>
        <label for="cara_buat">Cara Buat:</label>
        <textarea id="cara_buat" name="cara_buat" class="animasi" placeholder="Ketikkan disini"></textarea>
      </fieldset>
    </div>
    <div class="panel-resep" style="height:326px;margin-top:-332px;">
      <div class="data-resep">
        <div class="sub">Resep</div>
        <button class="btn-atur-resep brick animasi" onclick="pilih_bahan()" type="button" name="atur" id="atur">Atur</button>
        <div id="dataresep">
          <table width="100%" id="t_resep" name="t_resep">
          </table>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="tempimg" id="tempimg" value=1>
</form>
@if(session()->has('message'))
  <script>
  swal({
    title: "{{session()->get('title')}}",
    text: "{{session()->get('message')}}",
    type: "{{session()->get('type')}}",
    confirmButtonColor: "#2b5dcd",
    confirmButtonText: "OK",
    closeOnConfirm: true
  });
  </script>
  <?php
    session()->forget('message');
  ?>
@endif
