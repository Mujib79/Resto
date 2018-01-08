<?php if(count($datalists)>0): ?>
  <?php $__currentLoopData = $datalists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datalist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($datalist->nama); ?>"><?php echo e($datalist->nama); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
