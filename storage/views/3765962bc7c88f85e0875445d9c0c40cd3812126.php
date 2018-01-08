<?php if(count($datas)>0): ?>
  <div class="panel-process">
    <span id="img-title" class="spending"></span>
    <label id="label-title">Pengeluaran | Belanja Bahan Baku</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Pemasukan" title="Mencari pemasukan"/></div>
  </div>
  <div class="wrap-table">
    <?php if(count($counts)>0): ?>
      <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if($count->jum>=15): ?>
        <div class="panelpaging">
          <?php 
          $jumbtn = intval($count->jum/15);
          if($count->jum % 15!=0){
            $jumbtn++;
          }
          $paging = 0;
          echo "Halaman: ";
          for ($i=1;$i<=$jumbtn;$i++) {
             ?>
            <button type="button" class="brick animasi paging" id="paging<?php echo e($i); ?>" onclick="paging(<?php echo e($paging); ?>,'#paging<?php echo e($i); ?>',1)"><?php echo e($i); ?></button>
            <?php 
            $paging = $paging + 15;
          }
           ?>
          <input type="hidden" id="temppaging" value="#paging1">
          <script type="text/javascript">
            $("#paging1").toggleClass("activepaging");
          </script>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <table id="data-table" class="data-table tabellaporan">
      <thead>
        <tr>
          <th>Nomor Laporan</th>
          <th>Tanggal Buat</th>
          <th>Anggaran</th>
          <th>Belanja</th>
          <th>Pembuat</th>
          <th colspan="2">Proses</th>
        </tr>
      </thead>
      <tbody id="bodycontent">
          <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr title="Terakhir diubah pada: <?php echo e($data->update); ?>">
              <td><?php echo e($data->no_report); ?></td>
              <td><?php echo e($data->tanggal); ?></td>
              <td>Rp. <?php echo e(number_format($data->budget,0,',','.')); ?></td>
              <td>Rp. <?php echo e(number_format($data->belanja,0,',','.')); ?></td>
              <td><?php echo e($data->nama); ?></td>
            <?php if(count($status)>0): ?>
              <td><button onclick="detail_data(<?php echo e($data->no_report); ?>)" class="green" type="button">Detail</button></td>
              <td><button onclick="delete_data(<?php echo e($data->no_report); ?>,1)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
            <?php else: ?>
              <td><button onclick="restore_laporan(<?php echo e($data->no_report); ?>)" class="restore prosesbtn green" type="button">Restore</button></td>
              <td><button onclick="delete_data(<?php echo e($data->no_report); ?>,0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
            <?php endif; ?>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </div>
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
