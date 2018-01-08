<?php 
  $i=1;
 ?>
<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><?php echo e($i++); ?></td>
    <td><?php echo e($data->NIP); ?></td>
    <td><?php echo e($data->nama); ?></td>
    <td style="text-transform:capitalize"><?php echo e(strtolower($data->jabatan)); ?></td>
    <td><?php echo e($data->masuk); ?></td>
    <td><button type="button" class="whiteedit prosesbtn green animasi">Edit</button></td>
    <td><button type="button" onclick="hapuspegawai('<?php echo e($data->NIP); ?>','<?php echo e($data->nama); ?>')" class="whitetrash prosesbtn red animasi">Hapus</button></td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
