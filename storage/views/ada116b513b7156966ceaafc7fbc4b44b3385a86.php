<?php if(count($datas)>0): ?>
  <div class="panel-process">
    <span id="img-title" class="feedback"></span>
    <label id="label-title">Umpan Balik Pelanggan</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Umpan Balik" title="Mencari Umpan Balik"/></div>
  </div>
  <div class="wrap-table">
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
          <button type="button" class="brick animasi paging" id="paging<?php echo e($i); ?>" onclick="paging(<?php echo e($paging); ?>,'#paging<?php echo e($i); ?>',0)"><?php echo e($i); ?></button>
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
    <div class="option">
      <button type="button" onclick="delete_row_feedback('temporarycheck')" style="margin-left: 10px;" id="hps" class="green1 prosesbtn blacktrash animasi">Hapus Baris</button>
    </div>
    <form id="temporarycheck" name="temporarycheck" method="post">

    </form>
    <table id="data-table" class="data-table feedbacktbl">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkmaster" onclick="clickAll('data-table')"></th>
          <th>Tanggal</th>
          <th>Perihal</th>
          <th>Konten</th>
        </tr>
      </thead>
      <tbody id="bodycontent">
        <?php 
          $i=1;
         ?>
        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><input onclick="temp_data(<?php echo e($i); ?>,this)" type="checkbox" id="check<?php echo e($i); ?>" value="<?php echo e($data->no_pemesanan); ?>"></td>
            <td onclick="ceklis_tanda(<?php echo e($i); ?>)"><?php echo e($data->tanggal); ?></td>
            <td onclick="ceklis_tanda(<?php echo e($i); ?>)"><?php echo e($data->perihal); ?></td>
            <td onclick="ceklis_tanda(<?php echo e($i++); ?>)"><?php echo e($data->konten); ?></td>
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
