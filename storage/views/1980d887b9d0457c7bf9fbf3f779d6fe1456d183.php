<?php if(count($datas)>0): ?>
  <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr title="Terakhir diubah pada: <?php echo e($data->update); ?>">
      <td><?php echo e($data->no_report); ?></td>
      <td><?php echo e($data->tanggal); ?></td>
      <td>Rp. <?php echo e(number_format($data->budget,0,',','.')); ?></td>
      <td>Rp. <?php echo e(number_format($data->belanja,0,',','.')); ?></td>
      <td><?php echo e($data->nama); ?></td>
    <?php if(count($status)>0): ?>
      <td><button onclick="detail_data(<?php echo e($data->no_report); ?>)" class="green" type="button">Detail</button></td>
      <td><button onclick="delete_data(<?php echo e($data->no_report); ?>,1)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
    <?php else: ?>
      <td><button onclick="restore_laporan(<?php echo e($data->no_report); ?>)" class="restore prosesbtn green" type="button">Restore</button></td>
      <td><button onclick="delete_data(<?php echo e($data->no_report); ?>,0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
    <?php endif; ?>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
  <center>
    <div class="not-found">
      <?php echo e($pesan); ?>

    </div>
  </center>
<?php endif; ?>
