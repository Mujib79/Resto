<?php if(count($datas)>0): ?>
  <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($data->nama); ?></td>
      <td><?php echo e($data->qty); ?></td>
      <td>Rp. <?php echo e(number_format($data->harga,0,',','.')); ?></td>
      <td>Rp. <?php echo e(number_format($data->harga*$data->qty,0,',','.')); ?></td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
