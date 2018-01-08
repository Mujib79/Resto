<?php if(count($datas_tbl)>0): ?>
  <?php 
    $i=1;
   ?>
  <?php $__currentLoopData = $datas_tbl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datatbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php 
      if ($datatbl->status==1) {
        $stsclass = "available1";
      }else{
        $stsclass = "notavailable1";
      }
     ?>
    <tr>
      <td><input onclick="temp_data(<?php echo e($i); ?>,this,0)" type="checkbox" id="check<?php echo e($i); ?>" value="<?php echo e($datatbl->no); ?>"></td>
      <td><?php echo e($i++); ?></td>
      <td><?php echo e($datatbl->nama); ?></td>
      <td class="<?php echo e($stsclass); ?> stsfood"></td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
