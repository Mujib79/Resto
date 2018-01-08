<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="panel-process" id="paneleditor">
  <span id="img-title" class="employee"></span>
  <label id="label-title">Olah Data Pegawai</label>
</div>
<div class="wrap-table" id="editorcontent">
  <form id="serialdataedit" method="post">
    <div id="top">
      <table>
        <tr>
          <td width="8%"><label for="nip">*NIP :</label></td>
          <td width="21%"><input type="text" name="nip" id="nip" value="<?php echo e($data->NIP); ?>"></td>
          <td width="21%"><label for="namapegawai">*Nama Pegawai :</label></td>
          <td width="50%"><input type="text" name="nama" id="namapegawai" value="<?php echo e($data->nama); ?>"></td>
        </tr>
      </table>
    </div>
    <hr>
    <div id ="center">
      <div id="left">
        <div class="panelimage">
            <img src="<?php echo e($url); ?>" id="img">
        </div>
      </div>
      <div id="right">
        <fieldset style="width:95%">
          <label for="jabat">Jabatan Pegawai:</label>
          <select name="jabatan" id="jabat">
            <option value="">Pilih Jabatan</option>
            <option value="KOKI">Koki</option>
            <option value="PANTRY">Pantry</option>
            <option value="KASIR">Kasir</option>
            <option value="PRAMUSAJI">Pramusaji</option>
          </select>
          <label>*Jenis Kelamin :</label>
          <div class="panelradio">
            <input type="radio" name="kelamin" value="P" id="Pria"><label for="Pria">Pria</label>
            <input type="radio" name="kelamin" value="W" id="Wanita"><label for="Wanita">Wanita</label>
          </div>

          <label for="masuk">*Tanggal Masuk :</label>
          <input type="text" name="masuk" id="masuk" value="<?php echo e($data->masuk); ?>" readonly>

          <label for="telepon">Telepon :</label>
          <input type="text" name="telepon" id="telepon" value="<?php echo e($data->telepon); ?>">
        </fieldset>
      </div>
    </div>
    <div id="bottom">
      <fieldset style="text-align:left;width: 100%">
        <label for="alamatpegawai">Alamat:</label>
        <textarea style="width:100%;height:80px" id="alamatpegawai" name="alamatpegawai"><?php echo e($data->alamat); ?></textarea>
      </fieldset>
      <button style="margin-top:5px;margin-bottom:5px" onclick="simpanpegawai(0)" type="button" class="green save prosesbtn animasi">Simpan</button>
      <button type="button" onclick="sort_data('olah-pegawai')" class="red animasi">Batal</button>
    </div>
    <input type="hidden" name="tempnip" id="tempnip" value="<?php echo e($data->NIP); ?>">
  </form>
</div>
<script type="text/javascript">
  document.getElementById("jabat").value = "<?php echo e($data->jabatan); ?>";
  if ("<?php echo e($data->kelamin); ?>"=="P") {
    document.getElementById("Pria").checked = true;
  }else{
    document.getElementById("Wanita").checked = true;
  }
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
