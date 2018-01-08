<?php $__env->startSection('popup'); ?>
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
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('child'); ?>
  <ul class="list-button">
    <li class="firstmenu"><a class="dashboard animasi" href="dashboard">Dashboard</a></li>
    <li class="firstmenu"><a class="kitchen animasi" href="dapur">Mode Dapur</a></li>
    <li class="active firstmenu"><a class="dish animasi" href="#">Olah Hidangan</a></li>
    <li>
      <ul>
        <li><a id="a1" class="minus" href="#" onclick="tampil_child('#second-child1','#a1')">Tampilkan Hidangan</a></li>
        <li>
          <ul id="second-child1" class="max">
            <li onclick="sort_data('ALL')" id="ALL"><a onclick="change_color('#ALL')" class="allfood" href="#">Semua</a></li>
            <li onclick="sort_data('APP')" id="APP"><a onclick="change_color('#APP')" class="app" href="#">Hidangan Pembuka</a></li>
            <li onclick="sort_data('MAC')" id="MAC"><a onclick="change_color('#MAC')" class="mac" href="#">Hidangan Utama</a></li>
            <li onclick="sort_data('DES')" id="DES"><a onclick="change_color('#DES')" class="des" href="#">Hidangan Penutup</a></li>
            <li onclick="sort_data('SOF')" id="SOF"><a onclick="change_color('#SOF')" class="sof" href="#">Minuman</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li>
      <ul>
        <li><a id="a2" class="plus" href="#" onclick="tampil_child('#second-child2','#a2')">Olah Data Hidangan</a></li>
        <li>
          <ul id="second-child2">
            <li id="new" onclick="add_new(0)"><a onclick="change_color('#new')" class="new" href="#">Tambah Hidangan Baru</a></li>
            <li onclick="sort_data('trash')" id="trash"><a onclick="change_color('#trash')" class="trash" href="#">Sampah Hidangan</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li>
      <ul>
        <li><a id="a3" class="plus" href="#" onclick="tampil_child('#second-child3','#a3')">Olah Ketersediaan Hidangan</a></li>
        <li>
          <ul id="second-child3">
            <li onclick="sort_data('available')" id="available"><a onclick="change_color('#available')" class="available" href="#">Tersedia</a></li>
            <li onclick="sort_data('notavailable')" id="notavailable"><a onclick="change_color('#notavailable')" class="notavailable" href="#">Tidak Tersedia</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li>
      <ul>
        <li><a id="a4" class="plus" href="#" onclick="tampil_child('#second-child4','#a4')">Olah Bahan Baku</a></li>
        <li>
          <ul id="second-child4">
            <li onclick="sort_data('shing')" id="shing"><a onclick="change_color('#shing')" class="basket" href="#">Lihat Bahan Baku</a></li>
            <li id="newing" onclick="popup('addbahanbaku',1)"><a class="new" href="#">Tambah Bahan Baku Baru</a></li>
            <li onclick="sort_data('trashing')" id="trashing"><a onclick="change_color('#trashing')" class="trash" href="#">Sampah Bahan Baku</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
  <input type="hidden" id="tempid" value="#<?php echo e($id); ?>">
  <script type="text/javascript">
    $("#<?php echo e($id); ?>").addClass("active-child");
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('koki.operation.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.parent-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>