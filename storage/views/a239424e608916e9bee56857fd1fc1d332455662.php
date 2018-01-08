<?php if(count($datas)>0): ?>
  <?php 
    $i=1;
   ?>
  <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($i++); ?></td>
      <td><?php echo e($data->tanggal); ?></td>
      <td>Rp. <?php echo e(number_format($data->total,0,',','.')); ?></td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <script type="text/javascript">
  if($("#tempbulanan")[0]!=null){
    $("#tempbulanan").val($("#bulan").val());
  }
  $("#temptahunan").val($("#tahun").val());
  </script>
<?php else: ?>
  <tr>
    <td colspan="3" style="text-align:center !important;background-color:#fff !important">Data pemasukan tidak ditemukan</td>
  </tr>
  <script type="text/javascript">
  if($("#tempbulanan")[0]!=null){
    $("#tempbulanan").val("");
  }
  $("#temptahunan").val("");
  </script>
<?php endif; ?>
