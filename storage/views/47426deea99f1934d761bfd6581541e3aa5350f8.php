<script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
</script>
<?php $__currentLoopData = $ings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="panel-header">
  <button type="button" class="red back prosesbtn animasi" id="simpan" onclick="show('olah-bahan-baku')" name="button">Kembali</button>
</div>
<div class="panel-ing">
  <span style="margin-right: 25px;font-weight:bold;font-size:20px;">Nama Bahan : <?php echo e($ing->nama); ?></span>
  <span style="font-weight:bold;font-size:20px;">Satuan : <input type="text" onchange="save_data('satuan',<?php echo e($ing->no); ?>,'',this)" id="satuan" value="<?php echo e($ing->satuan); ?>"></span>
</div>
<div style="height: calc(100vh - 182px);" class="wrap-table">
  <div class="option">
    <button type="button" onclick="add_new_row(<?php echo e($ing->no); ?>,0)" style="margin-left: 1%;" class="brick plus prosesbtn animasi">Tambah Baris</button>
    <button type="button" id="hps" onclick="delete_row(<?php echo e($ing->no); ?>,0)" style="margin-left: 5px;" class="green1 blacktrash prosesbtn animasi" disabled="disabled">Hapus Baris</button>
  </div>
  <form id="serialdata" method="post" role="form" enctype="multipart/form-data">

  </form>
  <table id="headtbldetail" class="data-table">
    <thead>
      <tr>
        <th rowspan="2"><input type="checkbox" onclick="clickAll('headtbldetail')" id="checkmaster"></th>
        <th colspan="3">Tanggal</th>
        <th rowspan="2">Jumlah</th>
        <th rowspan="2">Keterangan</th>
      </tr>
      <tr>
        <th>Beli</th>
        <th>Produksi</th>
        <th>Kadaluarsa</th>
      </tr>
    </thead>
    <tbody id="tbodydetail">
      <?php 
        $i=1;
       ?>
      <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><input onclick="temp_data(<?php echo e($i); ?>,this,1)" type="checkbox" value="<?php echo e($detail->no); ?>" id="check<?php echo e($i); ?>"></td>
          <td><input onchange="save_data('tgl_beli',<?php echo e($ing->no); ?>,<?php echo e($detail->no); ?>,this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_beli<?php echo e($i); ?>" id="tgl_beli<?php echo e($i); ?>" value="<?php echo e($detail->tgl_beli); ?>" readonly></td>
          <td><input onchange="save_data('tgl_produksi',<?php echo e($ing->no); ?>,<?php echo e($detail->no); ?>,this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_produksi<?php echo e($i); ?>" id="tgl_produksi<?php echo e($i); ?>" value="<?php echo e($detail->tgl_produksi); ?>" readonly></td>
          <td><input onchange="save_data('tgl_kadaluarsa',<?php echo e($ing->no); ?>,<?php echo e($detail->no); ?>,this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_kadaluarsa<?php echo e($i); ?>" id="tgl_kadaluarsa<?php echo e($i++); ?>" value="<?php echo e($detail->tgl_kadaluarsa); ?>" readonly></td>
          <td><input onchange="save_data('jumlah',<?php echo e($ing->no); ?>,<?php echo e($detail->no); ?>,this)" onblur="save_data('jumlah',<?php echo e($ing->no); ?>,<?php echo e($detail->no); ?>,this)" min=0 type="number" onkeyup="just_number(this)" name="jumlah" id="jumlah" value="<?php echo e($detail->jumlah); ?>"></td>
          <td><input onchange="save_data('keterangan',<?php echo e($ing->no); ?>,<?php echo e($detail->no); ?>,this)" type="text" name="jumlah" id="jumlah" value="<?php echo e($detail->ket); ?>"></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</div>
