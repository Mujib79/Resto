<table id="detailtabel" class="data-table">
  <thead>
    <tr>
      <th>Nama Hidangan</th>
      <th>Jumlah Pesan</th>
      <th colspan="3">Proses</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1 ?>
    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($data->nama); ?></td>
        <td><?php echo e($data->jml); ?></td>
        <td><button type="button" id="catatan<?php echo e($i); ?>" onclick="tampilkan_pesan('detailtabel',<?php echo e($i); ?>)" class="green1 animasi" name="button">Catatan</button></td>
        <?php if($data->sts==1): ?>
          <td><button type="button" id="btn<?php echo e($i); ?>" onclick="status_buat(<?php echo e($data->nopesan); ?>,2,<?php echo e($i); ?>,<?php echo e($data->notrans); ?>)" class="green animasi" name="button">Buat</button></td>
        <?php else: ?>
          <td><button type="button" id="btn<?php echo e($i); ?>" onclick="status_buat(<?php echo e($data->nopesan); ?>,3,<?php echo e($i); ?>,<?php echo e($data->notrans); ?>)" class="green animasi" name="button">Selesai</button></td>
        <?php endif; ?>
        <td style="border:none"><button type="button" onclick="status_buat(<?php echo e($data->nopesan); ?>,4,<?php echo e($i); ?>,<?php echo e($data->notrans); ?>)" class="red animasi" name="button">Tolak</button></td>
        <td style="width:0%;display:none;"><?php echo e($data->catatan); ?></td>
        <?php if($data->catatan==""): ?>
          <script type="text/javascript">
          document.getElementById("catatan<?php echo e($i); ?>").disabled = true;
          </script>
        <?php endif; ?>
        <?php 
          $i++;
         ?>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
