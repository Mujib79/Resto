<?php if(count($datas)>0): ?>
  <div class="panel-process">
    <span id="img-title"></span>
    <label id="label-title"></label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Pemasukan" title="Mencari pemasukan"/></div>
  </div>
  <div class="wrap-table">
      <div class="option">
        <input type="hidden" id="temptahunan" value="<?php echo date('Y') ?>">
        <?php if($id!="tahunan"): ?>
          <label>Cari pemasukan pada:</label>
          <?php if(($id=="harian")||($id=="bulanan")): ?>
            <?php if($id=="harian"): ?>
              <input type="hidden" id="tempbulanan" value="<?php echo date('m') ?>">
              <select id="bulan">
                <option value="">Pilih Bulan</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
              <script type="text/javascript">
                document.getElementById("bulan").value = "<?php echo date('m') ?>";
              </script>
            <?php endif; ?>
            <select id="tahun">
              <option value="">Pilih Tahun</option>
              <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($year->tahun); ?>"><?php echo e($year->tahun); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <script type="text/javascript">
              document.getElementById("tahun").value = "<?php echo date('Y') ?>";
            </script>
          <?php endif; ?>
          <button type="button" class="whiteproses prosesbtn green animasi" onclick="sort_proses()">Proses</button>
        <?php endif; ?>
        <button type="button" style="margin-left: 10px;" class="backup brick prosesbtn animasi" title="Backup data" onclick="backup('<?php echo e($id); ?>')">Backup</button>
      </div>
    <table id="data-table" class="data-table tabel-pemasukan">
      <thead>
        <tr>
          <th>Nomor</th>
          <th>Tanggal</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody id="bodycontent">
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
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    switch ("<?php echo e($id); ?>") {
      case "harian" : imgtitle = "dayincome";ket="Pemasukan | Harian";
      break;
      case "bulanan" : imgtitle = "monthincome";ket="Pemasukan | Bulanan";
      break;
      case "tahunan" : imgtitle = "yearincome";ket="Pemasukan | Tahunan";
      break;
      case "pengeluaran" : imgtitle = "spending";ket="Pengeluaran | Belanja Bahan Baku";
      break;
    }
    $("#img-title").addClass(imgtitle);
    $("#label-title").html(ket);
  </script>
<?php else: ?>
  <center>
    <div class="not-found">
      <?php echo e($pesan); ?>

    </div>
  </center>
<?php endif; ?>
<script type="text/javascript">
$("#<?php echo e($id); ?>").addClass("active-child");
$("#tempid").val("<?php echo e("#$id"); ?>");
</script>
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
