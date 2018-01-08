<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <title>My Resto | Pemesanan</title>
  </head>
  <script type="text/javascript" src="<?php echo asset('public/js/jquery.js'); ?>"></script>
  <meta http-equiv="Cache-Control" content="no-store" />
  <link rel="stylesheet" href="<?php echo asset('public/css/sweetalert.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('public/css/pemesanan.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('public/css/public.css'); ?>">
  <script type="text/javascript" src="<?php echo asset('public/js/sweetalert.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/public.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/pemesanan.js'); ?>"></script>
  <body>
    <div id="load"></div>
    <div id="popupBox">
      <div id="catatan" class="wrapper">
        <div class="head">
          <fieldset>
            <div><label>Catatan</label></div>
            <button type="button" class="close animasi" onclick="popup('catatan',0)">X</button>
          </fieldset>
        </div>
        <center>
          <div id="kolomisian">
          </div>
        </center>

      </div>

      <div id="feedback" class="wrapper">
        <div class="head">
          <fieldset>
            <div><label>Umpan Balik</label></div>
            <button type="button" class="close animasi" onclick="popup('feedback',0)">X</button>
          </fieldset>
        </div>
        <center>
          <div id="kolomfeedback">
            <form id="formfeedback" method="post">
              <label for="perihal">Perihal:</label>
              <input type="text" name="perihal" id="perihal" placeholder="Perihal/Judul">
              <label for="feedback">Konten:</label>
              <textarea placeholder="Kiritik/Saran" id="feedback" name="feedback"></textarea>
            </form>
            <button style="margin-top: 5px;margin-bottom:5px" onclick="simpan_feedback()" class="green save prosesbtn animasi" type="button">Simpan</button>
          </div>
        </center>

      </div>

      <div id="logoutpop" class="wrapper">
        <div class="head">
          <fieldset>
            <div><label>Validasi Untuk Keluar</label></div>
            <button type="button" class="close animasi" onclick="popup('logoutpop',0)">X</button>
          </fieldset>
        </div>
        <center>
          <div id="kolomlogout">
            <form id="seriallogout" method="post">
              <fieldset style="text-align:left">
                <label for="nip">NIP:</label>
                <input style="width: 100%;margin-bottom:10px;" type="text" name="nip" id="nip" placeholder="Masukkan NIP anda">
                <label for="password">Password:</label>
                <input style="width: 100%;margin-bottom:10px;" type="password" name="password" id="password" placeholder="Masukkan password">
              </fieldset>
            </form>
            <button style="margin-bottom:10px;" onclick="validasi_logout()" type="button" class="green animasi">Validasi</button>
          </div>
        </center>

      </div>
    </div>
    <div id="dashboard">
      <div id="dashboardheader">
        <label class="judul">My Resto</label>
        <aside>
            <button class="brick logout prosesbtn sign animasi" id="out" onclick="popup('logoutpop',1)" name="out" type="button">LOG OUT</button>
        </aside>
        <div id="opsi-pelanggan">
          <button class="brick list-hidangan prosesbtn animasi active" onclick="change_state('#list-hidangan')" type="button" id="list-hidangan"></button>
          <button class="brick trolley prosesbtn animasi" onclick="change_state('#keranjang')" type="button" id="keranjang"><span id="notification">0</span></button>
          <input type="hidden" id="tempfirstid" value="#list-hidangan">
        </div>
        <div id="shsearch">
          <input type="text" class="animasi" placeholder="Cari Hidangan" onkeyup="search_dish(this,0)">
        </div>
      </div>
      <div id="pesanan" class="hidden">
        <div class="wrap-table order-table">
          <div class="option" style="text-align:right !important">
            <label id="infolist">Daftar Pesanan Anda</label>
            <button type="button" style="margin-right: 10px;" onclick="order()" class="brick prosesbtn animasi cooking">Pesan</button>
            <button type="button" style="margin-right: 10px;" onclick="bayar()" class="green prosesbtn animasi buy">Bayar</button>
          </div>
          <table id="order-table" class="data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                <th colspan="2">Proses</th>
              </tr>
            </thead>
            <tbody id="bodycontent">

            </tbody>
          </table>
        </div>
        <div class="option foot">
          <table>
            <tr>
              <th>Total Belanja Anda</th>
              <td>:</td>
              <td id="hitungbelanja">Rp. 0</td>
            </tr>
          </table>
        </div>
      </div>
      <div id="dashboardbody">
        <div class="kelompok_tipe">
          <div class="title_tipe">
            Hidangan Pembuka
          </div>
          <?php if(count($APPS)>0): ?>
            <?php $__currentLoopData = $APPS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $APP): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
              if(file_exists('storage/app/public/gambar/'.$APP->no.'.jpeg')){
                $url = asset("storage/app/public/gambar/$APP->no.jpeg");
              }else{
                $url = asset("public/gambar/notfound.png");
              }
               ?>
              <div class="dishpanel animasi" onclick="set_order(<?php echo e($APP->no); ?>,'<?php echo e($APP->nama); ?>',<?php echo e($APP->harga); ?>)">
                <img src="<?php echo e($url); ?>">
                <div class="info">
                  <table>
                    <tr>
                      <th><?php echo e($APP->nama); ?></th>
                    </tr>
                    <tr>
                      <th>Rp. <?php echo e(number_format($APP->harga,0,',','.')); ?></th>
                    </tr>
                  </table>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </div>
        <div class="kelompok_tipe">
          <div class="title_tipe">
            Hidangan Utama
          </div>
          <?php if(count($MACS)>0): ?>
            <?php $__currentLoopData = $MACS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $MAC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
              if(file_exists('storage/app/public/gambar/'.$MAC->no.'.jpeg')){
                $url = asset("storage/app/public/gambar/$MAC->no.jpeg");
              }else{
                $url = asset("public/gambar/notfound.png");
              }
               ?>
              <div class="dishpanel animasi" onclick="set_order(<?php echo e($MAC->no); ?>,'<?php echo e($MAC->nama); ?>',<?php echo e($MAC->harga); ?>)">
                <img src="<?php echo e($url); ?>">
                <div class="info">
                  <table>
                    <tr>
                      <th><?php echo e($MAC->nama); ?></th>
                    </tr>
                    <tr>
                      <th>Rp. <?php echo e(number_format($MAC->harga,0,',','.')); ?></th>
                    </tr>
                  </table>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </div>
        <div class="kelompok_tipe">
          <div class="title_tipe">
            Hidangan Penutup
          </div>
          <?php if(count($DESS)>0): ?>
            <?php $__currentLoopData = $DESS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $DES): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
              if(file_exists('storage/app/public/gambar/'.$DES->no.'.jpeg')){
                $url = asset("storage/app/public/gambar/$DES->no.jpeg");
              }else{
                $url = asset("public/gambar/notfound.png");
              }
               ?>
              <div class="dishpanel animasi" onclick="set_order(<?php echo e($DES->no); ?>,'<?php echo e($DES->nama); ?>',<?php echo e($DES->harga); ?>)">
                <img src="<?php echo e($url); ?>">
                <div class="info">
                  <table>
                    <tr>
                      <th><?php echo e($DES->nama); ?></th>
                    </tr>
                    <tr>
                      <th>Rp. <?php echo e(number_format($DES->harga,0,',','.')); ?></th>
                    </tr>
                  </table>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </div>
        <div class="kelompok_tipe">
          <div class="title_tipe">
            Minuman
          </div>
          <?php if(count($SOFS)>0): ?>
            <?php $__currentLoopData = $SOFS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $SOF): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
              if(file_exists('storage/app/public/gambar/'.$SOF->no.'.jpeg')){
                $url = asset("storage/app/public/gambar/$SOF->no.jpeg");
              }else{
                $url = asset("public/gambar/notfound.png");
              }
               ?>
              <div class="dishpanel animasi" onclick="set_order(<?php echo e($SOF->no); ?>,'<?php echo e($SOF->nama); ?>',<?php echo e($SOF->harga); ?>)">
                <img src="<?php echo e($url); ?>">
                <div class="info">
                  <table>
                    <tr>
                      <th><?php echo e($SOF->nama); ?></th>
                    </tr>
                    <tr>
                      <th>Rp. <?php echo e(number_format($SOF->harga,0,',','.')); ?></th>
                    </tr>
                  </table>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <input type="hidden" id="tempjum" value="0">
    <input type="hidden" id="temppesan" value="0">
    <input type="hidden" id="temploop" value=<?php echo e($_SESSION["statusbayar"]); ?>>
  </body>
  <script type="text/javascript">
    var loadinterval;
    if($("#temploop").val()==1){
      // load_keranjang();
      start_interval();
    }
    function start_interval(){
      loadinterval=setInterval("load_keranjang()",3000);
    }
    function stop_interval(){
      clearInterval(loadinterval);
    }
  </script>
</html>
<?php if(session()->has('message')): ?>
  <script>
  swal({
    title: "<?php echo e(session()->get('title')); ?>",
    text: "<?php echo e(session()->get('message')); ?>",
    type: "<?php echo e(session()->get('type')); ?>",
    confirmButtonColor: "#2b5dcd",
    confirmButtonText: "OK",
    closeOnConfirm: true
  });
  </script>
  <?php session()->forget('message');?>
<?php endif; ?>
