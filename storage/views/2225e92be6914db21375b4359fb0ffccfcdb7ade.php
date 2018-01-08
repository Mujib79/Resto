<div id="ganti" class="panel-process">
  <span id="img-title" class="password"></span>
  <label id="label-title">Ganti Password</label>
</div>
<div id="panelganti">
  <form id="serialize" method="post">
    <fieldset>
      <label for="plama">Passwordn Lama :</label>
      <input type="password" name="plama" id="plama" placeholder="Password Lama">
      <label for="pbaru">Password Baru :</label>
      <input type="password" name="pbaru" id="pbaru" placeholder="Password Baru">
      <label for="pkonfirmasi">Konfirmasi Password Baru :</label>
      <input type="password" name="pkonfirmasi" id="pkonfirmasi" placeholder="Isi Kembali Password Baru">
    </fieldset>
  </form>
  <center>
    <button type="button" style="margin-top: 5px;margin-right:5px;" onclick="ganti_password()" class="save prosesbtn green animasi">Simpan</button>
    <button type="button" class="red animasi" onclick="clear_form()">Batal</button>
  </center>
</div>
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
