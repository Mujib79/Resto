<table class="data-table">
  <thead>
    <tr>
      <th>Nomor Meja</th>
      <th>Jumlah Pesan</th>
    </tr>
  </thead>
  <tbody>
    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr onclick="show_detail(<?php echo e($data->nopesan); ?>)">
        <td><?php echo e($data->no_meja); ?></td>
        <td><?php echo e($data->jum); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
