<?php $__env->startSection('title','Welcome'); ?>

<?php $__env->startSection('body'); ?>
  Welcome
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>