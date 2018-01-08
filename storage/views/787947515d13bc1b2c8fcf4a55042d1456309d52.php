<?php if(count($datas)>0): ?>
  <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr title="Terakhir diubah pada: <?php echo e($data->update); ?>">
      <td><?php echo e($data->no_report); ?></td>
      <td><?php echo e($data->tanggal); ?></td>
      <td>Rp. <?php echo e(number_format($data->budget,0,',','.')); ?></td>
      <td>Rp. <?php echo e(number_format($data->belanja,0,',','.')); ?></td>
      <td><?php echo e($data->nama); ?></td>
      <?php if($status==1): ?>
        <td><button onclick="kirim(<?php echo e($data->no_report); ?>)" class="blackupload prosesbtn brick" type="button" title="Mengirim laporan ke manager">Kirim</button></td>
        <td><button onclick="edit_data(<?php echo e($data->no_report); ?>)" class="whiteedit prosesbtn green" type="button">Edit</button></td>
        <td><button onclick="delete_data(<?php echo e($data->no_report); ?>,1)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
      <?php else: ?>
        <td><button class="blackupload prosesbtn brick" type="button" title="Mengirim laporan ke manager" disabled="disabled">Kirim</button></td>
        <td><button onclick="restore_laporan(<?php echo e($data->no_report); ?>)" class="restore prosesbtn green" type="button">Restore</button></td>
        <td><button onclick="delete_data(<?php echo e($data->no_report); ?>,0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
      <?php endif; ?>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<script>
<?php if(session()->has('message')): ?>
  swal({
    title: "<?php echo e(session()->get('title')); ?>",
    text: "<?php echo e(session()->get('message')); ?>",
    type: "<?php echo e(session()->get('type')); ?>",
    confirmButtonColor: "#2b5dcd",
    confirmButtonText: "OK",
    closeOnConfirm: true
  });
  <?php session()->forget('message');?>
<?php endif; ?>
</script>
