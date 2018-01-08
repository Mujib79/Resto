<?php if(count($datas)>0): ?>
  <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr onclick="detail_pesan(<?php echo e($data->no); ?>,<?php echo e($data->no_meja); ?>,this)">
      <td><?php echo e($data->no_meja); ?></td>
      <td data-value="<?php echo e($data->total); ?>">Rp. <?php echo e(number_format($data->total,0,',','.')); ?></td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
