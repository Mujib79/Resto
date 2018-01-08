<?php 
  $i=1;
 ?>
<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><input onclick="temp_data(<?php echo e($i); ?>,this)" type="checkbox" id="check<?php echo e($i); ?>" value="<?php echo e($data->no_pemesanan); ?>"></td>
    <td onclick="ceklis_tanda(<?php echo e($i); ?>)"><?php echo e($data->tanggal); ?></td>
    <td onclick="ceklis_tanda(<?php echo e($i); ?>)"><?php echo e($data->perihal); ?></td>
    <td onclick="ceklis_tanda(<?php echo e($i++); ?>)"><?php echo e($data->konten); ?></td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
