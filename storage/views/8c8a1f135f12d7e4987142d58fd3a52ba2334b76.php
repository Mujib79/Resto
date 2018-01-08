<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <title>Resto | Kasir</title>
  </head>
  <meta http-equiv="Cache-Control" content="no-store" />
  <link rel="stylesheet" href="<?php echo asset('public/css/public.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('public/css/sweetalert.css'); ?>">
  <script type="text/javascript" src="<?php echo asset('public/js/sweetalert.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/jquery.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/public.js'); ?>"></script>
  <link rel="stylesheet" href="<?php echo asset('public/css/kasir.css'); ?>">
  <script type="text/javascript" src="<?php echo asset('public/js/kasir.js'); ?>"></script>
  <body>
    <header>
      <aside>
        <label class="judul">My Resto</label>
      </aside>
      <aside>
        <button class="brick logout prosesbtn sign animasi" id="out" onclick="log_out()" name="out" type="button">LOG OUT</button>
      </aside>
    </header>
    <div id="panelkasir">
      <aside id="left">
        <div class="list-akun">
          <table class="log-akun">
            <tr>
              <td rowspan=2 width=30%>
                <img id="fotoicon" src="<?php echo e($_SESSION["icon"]); ?>" width=60px height=60px>
              </td>
              <td>
                  <?php echo e($_SESSION["nip"]); ?>

              </td>
            </tr>
            <tr>
              <td>
                <?php echo e($_SESSION["nama"]); ?>

              </td>
            </tr>
          </table>
        </div>
        <div class="header">
          Daftar Pelanggan
        </div>
        <div id="data-pembeli">
          <table class="tabel-bayar">
            <thead>
              <tr>
                <th>Nomor Meja</th>
                <th>Total Bayar</th>
              </tr>
            </thead>
            <tbody id="bodytbl">

            </tbody>
          </table>
        </div>
      </aside>
      <aside id="right">
        <div class="panel-info">
          <button class="refresh prosesbtn brick  animasi" style="margin-right:10px" onclick="clear_data()" id="batal" type="button" disabled>Bersihkan</button>
          <button class="green save prosesbtn  animasi" onclick="save_pembayaran()" id="simpan" type="button" disabled>Simpan Transaksi</button>
        </div>
        <div id="calculate">
          <div class="input-div">
            <label class="animasi" id="lbl1" for="total_belanja">Total Belanja</label>
              <input type="text" name="total_belanja" id="total_belanja" readonly>
          </div>
          <div class="input-div">
            <label id="lbl2" class="animasi" for="uang_bayar">Uang Pembayaran</label>
              <input type="number" step="500" onkeyup="hitung_kembali(this.value);just_number(this)" min="0" onblur="unchange_label('lbl2',this)" name="uang_bayar" id="uang_bayar" readonly>
          </div>
          <div class="input-div">
            <label id="lbl3" class="animasi" for="uang_kembalian">Uang Kembalian</label>
              <input type="text" name="uang_kembalian" id="uang_kembalian" readonly>
          </div>
        </div>
        <div class="header">
          Detail Pesanan<span id="nomeja"></span>
        </div>
        <div id="wrap-detail-pesan">
          <table id="detail-pesan" class="tabel-bayar">
            <thead>
              <tr>
                <th>Nama Hidangan</th>
                <th>Jumlah Pesan</th>
                <th>Harga Satuan</th>
                <th>Harga Total</th>
              </tr>
            </thead>
            <tbody id="tabeldata">

            </tbody>
          </table>
        </div>
      </aside>
    </div>
  </body>
  <script type="text/javascript">
    get_data_pelanggan();
    setInterval("get_data_pelanggan()",3000);
    <?php if(session()->has('message')): ?>
      swal({
        title: "<?php echo e(session()->get('title')); ?>",
        text: "<?php echo e(session()->get('message')); ?>",
        type: "<?php echo e(session()->get('type')); ?>",
        confirmButtonColor: "#2b5dcd",
        confirmButtonText: "OK",
        closeOnConfirm: true
      });
    <?php session()->forget('message');?>
  <?php endif; ?>
  </script>
</html>
