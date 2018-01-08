<div width="80%" style="padding: 5px;" id="ChartContent">
    <canvas id="lineChart" height="80px"></canvas>
</div>
<br>
<center>
    <label for="pilihtahun"> Tahun Pemasukan </label>
    <select id="pilihtahun">
      <option value="">Pilih Tahun</option>
      <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($year->tahun); ?>"><?php echo e($year->tahun); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="button" class="green whiteproses prosesbtn animasi" onclick="showChart();"> Proses</button>
</center>
<br>
<hr style="border: 1px dashed; margin:5px 0px;">
<table id="dashboard">
  <tr>
    <td class="animasi" onclick="popup('addemployee',1)"><a class="new" href="#">Tambah Pegawai</a></td>
    <td class="animasi" onclick="set_interface('#f3','#second-child1','#a1','#first-child1');sort_data('harian')"><a class="dayincome" href="#">Pemasukan Harian</a></td>
    <td class="animasi" onclick="set_interface('#f3','#second-child1','#a1','#first-child1');sort_data('bulanan')"><a class="monthincome" href="#">Pemasukan Bulanan</a></td>
    <td class="animasi" onclick="set_interface('#f3','#second-child1','#a1','#first-child1');sort_data('tahunan')"><a class="yearincome" href="#">Pemasukan Tahunan</a></td>
  </tr>
  <tr>
    <td class="animasi" onclick="set_interface('#f3','#second-child2','#a2','#first-child1');sort_data('pengeluaran')"><a class="spending" href="#">Belanja Bahan Baku</a></td>
    <td class="animasi" onclick="set_interface('#f3','#second-child2','#a2','#first-child1');sort_data('trash')"><a class="trash" href="#">Sampah Laporan Belanja</a></td>
    <td class="animasi" onclick="set_interface('#f4','','','');sort_data('feedback')"><a class="feedback" href="#">Umpan Balik</a></td>
  </tr>
</table>
<?php if(count($datas) > 0): ?>
    <script type="text/javascript">
        var val = new Array(12);
        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           val[parseInt((<?php echo e($val->tanggal); ?>-1))] = <?php echo e($val->total); ?>;
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        var tahun = <?php echo e($val->tahun); ?>;
        addChart(val, tahun);
    </script>
<?php endif; ?>
