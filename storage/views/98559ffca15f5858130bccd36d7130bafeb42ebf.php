<?php $__env->startSection('tabledata'); ?>
  <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      switch ($data->kode) {
        case 'MAC':
            $jenis = "Hidangan Utama";
        break;
        case 'APP':
            $jenis = "Hidangan Pembuka";
        break;
        case 'DIS':
            $jenis = "Hidangan penutup";
        break;
        case 'SOF':
            $jenis = "MINUMAN";
        break;
      }
     ?>

    <tr>
      <td><?php echo e($data->no); ?></td>
      <td><?php echo e($data->nama); ?></td>
      <td><?php echo e($jenis); ?></td>
      <td><?php echo e($data->harga); ?></td>
      <td><input class="green" type="button" value="Edit"></td>
      <td><input class="red" type="button" value="Hapus"></td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('koki.operation.operation_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>