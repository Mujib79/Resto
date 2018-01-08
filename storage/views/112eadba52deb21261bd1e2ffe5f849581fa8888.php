<?php $__env->startSection('title'); ?>
  Manager
<?php $__env->stopSection(); ?>

<?php $__env->startSection('lib'); ?>
  <link rel="stylesheet" href="<?php echo asset('public/css/manager.css'); ?>">
  <script type="text/javascript" src="<?php echo asset('public/js/manager.js'); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('popup'); ?>
  <div id="popupBox">
    <div id="addemployee" class="wrapper">
      <div class="head">
        <fieldset>
          <div><label>Tambah Data Pegawai</label></div>
          <button type="button" class="close animasi" onclick="popup('addemployee',0);batalsimpan()">X</button>
        </fieldset>
      </div>
      <center>
        <div class="wrappop">
          <form id="serialdata" method="post">
            <fieldset>
              <label for="nama">Nama Pegawai:</label>
              <input type="text" name="nama" id="nama" placeholder="Ketikkan Nama Pegawai">
              <label for="jabatan">Jabatan Pegawai:</label>
              <select name="jabatan" id="jabatan">
                <option value="">Pilih Jabatan</option>
                <option value="KOKI">Koki</option>
                <option value="PANTRY">Pantry</option>
                <option value="KASIR">Kasir</option>
                <option value="PRAMUSAJI">Pramusaji</option>
              </select>
              <label>Jenis Kelamin:</label>
              <div class="panelradio">
                <input type="radio" name="kelamin" id="P" value="P"><label for="P">Pria</label>
                <input type="radio" name="kelamin" id="W" value="W"><label for="W">Wanita</label>
              </div>
              <center><label>Password pertama ialah 'admin'</label></center>
            </fieldset>
          </form>
        </div>
          <button type="button" style="margin-top:5px;margin-bottom:5px" onclick="simpanpegawai(1)" class="green animasi" name="Tetapkan" id="simpan">Simpan</button>
          <button type="button" style="margin-top:5px;margin-bottom:5px" onclick="batalsimpan()" class="brick animasi" name="Tetapkan" id="batal">Batal</button>
      </center>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('child'); ?>
  <ul class="list-button">
    <li class="active firstmenu" id="f1" onclick="sort_data('dashboard');change_color('#f1',0)"><a class="dashboard animasi" href="#">Dashboard</a></li>
    <li class="firstmenu" id="f2" onclick="sort_data('olah-pegawai');change_color('#f2',0)"><a class="employee animasi" href="#">Olah Data Pegawai</a></li>
    <li class="firstmenu" id="f3" onclick="tampil_child('#first-child1','')"><a id="firsta1" class="income animasi" href="#">Pemasukan dan Pengeluaran</a></li>
    <li>
      <ul id="first-child1">
        <li><a id="a1" class="plus" href="#" onclick="tampil_child('#second-child1','#a1')">Tampilkan Pemasukan</a></li>
        <li>
          <ul id="second-child1">
            <li onclick="sort_data('harian')" id="harian"><a onclick="change_color('#mingguan',1);change_color('#f3',0)" class="dayincome" href="#">Pemasukan Harian</a></li>
            <li onclick="sort_data('bulanan')" id="bulanan"><a onclick="change_color('#bulanan',1);change_color('#f3',0)" class="monthincome" href="#">Pemasukan Bulanan</a></li>
            <li onclick="sort_data('tahunan')" id="tahunan"><a onclick="change_color('#tahunan',1);change_color('#f3',0)" class="yearincome" href="#">Pemasukan Tahunan</a></li>
          </ul>
        </li>
        <li><a id="a2" class="plus" href="#" onclick="tampil_child('#second-child2','#a2')">Tampilkan Pengeluaran</a></li>
        <li>
          <ul id="second-child2">
            <li id="pengeluaran" onclick="sort_data('pengeluaran')"><a onclick="change_color('#pengeluaran',1);change_color('#f3',0)" class="spending" href="#">Belanja Bahan Baku</a></li>
            <li onclick="sort_data('trash');change_color('#f3',0);change_color('#trash',1)" id="trash"><a class="trash firstchildmenu" href="#">Sampah Laporan</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li class="firstmenu" id="f4" onclick="sort_data('feedback');change_color('#f4',0)"><a class="feedback animasi" href="#">Umpan Balik Pelanggan</a></li>
  </ul>
  <input type="hidden" id="tempfirstid" value="#f1">
  <input type="hidden" id="tempid" value="#">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('manager.operation.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.parent-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>