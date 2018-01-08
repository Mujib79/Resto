<?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="panel-header">
  <button type="button" class="red back prosesbtn animasi" id="kembali" onclick="sort_data('pengeluaran')" name="button">Kembali</button>
  <button type="button" style="margin-left: 10px;" class="backup brick prosesbtn animasi" title="Backup data" onclick="backup_pengeluaran(<?php echo e($report->no_report); ?>)">Backup</button>
</div>
<div class="panel-ing">
  <span style="margin-right: 25px;font-weight:bold;font-size:20px;">Nomor Laporan : <?php echo e($report->no_report); ?></span>
  <span style="font-weight:bold;font-size:20px;margin-right:25px">Tanggal : <?php echo e($report->tanggal); ?></span>
  <span style="font-weight:bold;font-size:20px;margin-right:25px">Anggaran : Rp. <?php echo e(number_format($report->budget,0,',','.')); ?></span>
  <span style="font-weight:bold;font-size:20px;">Total Belanja : Rp. <?php echo e(number_format($report->total,0,',','.')); ?></span>
</div>
<div class="wrap-table" id="editlaporan">
  <table id="data-table" class="data-table edittabellaporan">
    <thead>
      <tr>
        <th>Nomor</th>
        <th>Nama Bahan</th>
        <th>Harga Satuan</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody id="tbodydetail">
      <?php if(count($datas)>0): ?>
        <?php 
          $i = 1;
         ?>
        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($i++); ?></td>
            <td><?php echo e($data->nama_bahan); ?></td>
            <td>Rp. <?php echo e(number_format($data->satuan,0,',','.')); ?></td>
            <td><?php echo e($data->jumlah); ?></td>
            <td>Rp. <?php echo e(number_format($data->satuan*$data->jumlah,0,',','.')); ?></td>
            <td><?php echo e($data->keterangan); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    </tbody>
  </table>
  <datalist id="listsearch">

  </datalist>
</div>
