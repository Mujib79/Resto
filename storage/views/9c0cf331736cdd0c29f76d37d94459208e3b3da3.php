<?php 
  $i=1;
 ?>
<?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><input onclick="temp_data(<?php echo e($i); ?>,this,1)" type="checkbox" value="<?php echo e($detail->no); ?>" id="check<?php echo e($i); ?>"></td>
    <td><input onchange="save_data('tgl_beli',<?php echo e($no); ?>,<?php echo e($detail->no); ?>,this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_beli<?php echo e($i); ?>" id="tgl_beli<?php echo e($i); ?>" value="<?php echo e($detail->tgl_beli); ?>" readonly></td>
    <td><input onchange="save_data('tgl_produksi',<?php echo e($no); ?>,<?php echo e($detail->no); ?>,this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_produksi<?php echo e($i); ?>" id="tgl_produksi<?php echo e($i); ?>" value="<?php echo e($detail->tgl_produksi); ?>" readonly></td>
    <td><input onchange="save_data('tgl_kadaluarsa',<?php echo e($no); ?>,<?php echo e($detail->no); ?>,this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_kadaluarsa<?php echo e($i); ?>" id="tgl_kadaluarsa<?php echo e($i++); ?>" value="<?php echo e($detail->tgl_kadaluarsa); ?>" readonly></td>
    <td><input onblur="save_data('jumlah',<?php echo e($no); ?>,<?php echo e($detail->no); ?>,this)" onchange="save_data('jumlah',<?php echo e($ing->no); ?>,<?php echo e($detail->no); ?>,this)"  min=0 type="number" onkeyup="just_number(this)" name="jumlah" id="jumlah" value="<?php echo e($detail->jumlah); ?>"></td>
    <td><input onchange="save_data('keterangan',<?php echo e($no); ?>,<?php echo e($detail->no); ?>,this)" type="text" name="jumlah" id="jumlah" value="<?php echo e($detail->ket); ?>"></td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
</script>
