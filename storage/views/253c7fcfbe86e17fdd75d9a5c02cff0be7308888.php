<?php if(count($datas)>0): ?>
  <div class="panel-process">
    <span id="img-title"></span>
    <?php 
      if (count($status)>0){
          $title = "Semua Laporan";
          echo "<script>$('#img-title').addClass('all-data');</script>";
      }else{
          $title = "Sampah Laporan";
          echo "<script>$('#img-title').addClass('whitetrash');</script>";
      }
     ?>
    <label id="label-title">Olah Laporan Belanja | Semua Laporan</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Laporan Belanja" title="Mencari data laporan belanja"/></div>
  </div>
  <div class="wrap-table">
    <?php if($status==1): ?>
      <div class="option">
        <button type="button" onclick="add_new_report(1)" style="margin-left: 1%;" class="brick plus prosesbtn animasi">Buat Laporan Baru</button>
      </div>
    <?php endif; ?>
    
    <table id="data-table" class="data-table tabellaporan">
      <thead>
        <tr>
          <th>Nomor Laporan</th>
          <th>Tanggal Buat</th>
          <th>Anggaran</th>
          <th>Belanja</th>
          <th>Pembuat</th>
          <th colspan="3">Proses</th>
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
                <td><button onclick="kirim(<?php echo e($data->no_report); ?>)" class="blackupload prosesbtn brick" type="button" title="Mengirim laporan ke manager">Kirim</button></td>
                <td><button onclick="edit_data(<?php echo e($data->no_report); ?>)" class="whiteedit prosesbtn green" type="button">Edit</button></td>
                <td><button onclick="delete_data(<?php echo e($data->no_report); ?>,1)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
              <?php else: ?>
                <td><button class="blackupload prosesbtn brick" type="button" title="Mengirim laporan ke manager" disabled="disabled">Kirim</button></td>
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

      <br>
      <?php if(count($status)>0): ?>
        <button type="button" onclick="add_new_report(0)" class="new prosesbtn green" name="button">Klik untuk tambah data</button>
      <?php endif; ?>
    </div>
  </center>
<?php endif; ?>
<script type="text/javascript">
<?php if(session()->has('message')): ?>
    swal({
      title: "<?php echo e(session()->get('title')); ?>",
      text: "<?php echo e(session()->get('message')); ?>",
      type: "<?php echo e(session()->get('type')); ?>",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
<?php session()->forget('message');?>
<?php endif; ?>
</script>
