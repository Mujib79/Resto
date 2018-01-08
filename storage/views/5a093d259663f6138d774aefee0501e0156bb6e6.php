<?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo asset('public/css/backup.css'); ?>">
  </head>
  <body>
    <center>
      <h1>Laporan Belanja Bahan Baku</h1>
    </center>
    <hr>
    <table style="width: 100%;">
      <thead>
        <tr>
          <th>Nomor Laporan</th>
          <th>Tanggal Buat</th>
          <th>Anggaran</th>
          <th>Belanja</th>
          <th>Pembuat</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo e($report->no_report); ?></td>
          <td><?php echo e($report->tanggal); ?></td>
          <td>Rp. <?php echo e(number_format($report->budget,0,',','.')); ?></td>
          <td>Rp. <?php echo e(number_format($report->belanja,0,',','.')); ?></td>
          <td><?php echo e($report->nama); ?></td>
        </tr>
      </tbody>
    </table>
    <br>
    <b>Detail Belanja:</b>
    <table style="width:100%" class="belanjadetail">
      <thead>
        <tr>
          <th>Nomor</th>
          <th>Nama Bahan</th>
          <th>Harga Satuan</th>
          <th>Jumlah</th>
          <th>Keterangan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $i=1;
         ?>
        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($i++); ?></td>
            <td><?php echo e($data->nama_bahan); ?></td>
            <td>Rp. <?php echo e(number_format($data->satuan,0,',','.')); ?></td>
            <td><?php echo e($data->jumlah); ?></td>
            <td><?php echo e($data->keterangan); ?></td>
            <td>Rp. <?php echo e(number_format(($data->jumlah * $data->satuan),0,',','.')); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </body>
</html>
