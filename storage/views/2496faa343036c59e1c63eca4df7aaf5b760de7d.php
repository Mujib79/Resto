<div class="panel-process">
  <span id="img-title" class="kitchen"></span>
  <label id="label-title">Mode Dapur | Kelola Pesanan Pelanggan</label>
</div>
<div id="wrapdapur" class="wrap-table">
  <div id="list-pesan">
    <div class="title-list-pesan">
      Daftar Pemesan
    </div>
    <div id="wrap-table">

    </div>
  </div>
  <div id="daftar-pesanan">
    <div class="title-list-pesan">
      Daftar Pesanan Pelanggan
    </div>
    <div id="wrap-detail">

    </div>
  </div>
</div>
<script type="text/javascript">
  cek_pesanan();
  setInterval("cek_pesanan()",3000);
</script>

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
