<?php if(count($datas)>0): ?>
  <html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="<?php echo asset('public/css/backup.css'); ?>">
    </head>
    <body>
      <center>
        <h1>Pemasukan <?php echo e(ucfirst($sts)); ?></h1>
        <h2><?php echo e($pesan); ?></h2>
      </center>
      <hr><br>
      <table class="data-table">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
           ?>
          <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td style="text-align:right"><?php echo e($i++); ?></td>
              <td><?php echo e($data->tanggal); ?></td>
              <td>Rp. <?php echo e(number_format($data->total,0,',','.')); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </body>
  </html>
<?php endif; ?>
