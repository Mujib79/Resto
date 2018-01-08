<?php if(count($datas)>0): ?>
  <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <form id="formcatatan" method="post">
    <textarea name="catatan"><?php echo e($data->catatan); ?></textarea>
  </form>
  <button style="margin-top: 5px;margin-bottom:5px;" onclick="simpan_catatan(<?php echo e($data->no_transaksi); ?>)" class="green prosesbtn save animasi" type="button">Simpan</button>
<?php endif; ?>
