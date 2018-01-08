<?php if(count($datas)>0): ?>
  <?php 
  $i = 1;
   ?>
  <?php if(count($reports)>0): ?>
    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><input type="checkbox" value="<?php echo e($data->no_detail); ?>" id="check<?php echo e($i); ?>"></td>
        <td>
          <input type="text" id="namabahan" onkeyup="search_ing(this)" list="listsearch" onblur="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($report->no_report); ?>,0)" value="<?php echo e($data->nama_bahan); ?>">
        </td>
        <td><input id="hrgsatuan<?php echo e($i); ?>" type="number" onblur="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($report->no_report); ?>,1)" onchange="hitung_total(this,<?php echo e($i); ?>)" onkeyup="just_number(this);hitung_total(this,<?php echo e($i); ?>)" step="500" min="0" value="<?php echo e($data->satuan); ?>"></td>
        <td><input id="qty<?php echo e($i); ?>" type="number" onblur="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($report->no_report); ?>,2)" onchange="hitung_total(this,<?php echo e($i); ?>)" onkeyup="just_number(this);hitung_total(this,<?php echo e($i++); ?>)" min="0" value="<?php echo e($data->jumlah); ?>"></td>
        <td>Rp. <?php echo e(number_format($data->satuan*$data->jumlah,0,',','.')); ?></td>
        <td><input type="text" onblur="save_keterangan(this,<?php echo e($data->no_detail); ?>,<?php echo e($report->no_report); ?>)" value="<?php echo e($data->keterangan); ?>"></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php else: ?>
      <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><input type="checkbox" onclick="temp_data(<?php echo e($i); ?>,this,1)" value="<?php echo e($data->no_detail); ?>" id="check<?php echo e($i); ?>"></td>
          <td>
            <input type="text" id="namabahan" onkeyup="search_ing(this)" list="listsearch" onblur="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($no); ?>,0)" value="<?php echo e($data->nama_bahan); ?>">
          </td>
          <td><input id="hrgsatuan<?php echo e($i); ?>" type="number" onblur="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($no); ?>,1)" onchange="hitung_total(this,<?php echo e($i); ?>)" onkeyup="just_number(this);hitung_total(this,<?php echo e($i); ?>)" step="500" min="0" value="<?php echo e($data->satuan); ?>"></td>
          <td><input id="qty<?php echo e($i); ?>" type="number" onblur="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($no); ?>,2)" onchange="hitung_total(this,<?php echo e($i); ?>)" onkeyup="just_number(this);hitung_total(this,<?php echo e($i++); ?>)" min="0" value="<?php echo e($data->jumlah); ?>"></td>
          <td>Rp. <?php echo e(number_format($data->satuan*$data->jumlah,0,',','.')); ?></td>
          <td><input type="text" onblur="save_keterangan(this,<?php echo e($data->no_detail); ?>,<?php echo e($no); ?>)" value="<?php echo e($data->keterangan); ?>"></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
<?php endif; ?>
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
