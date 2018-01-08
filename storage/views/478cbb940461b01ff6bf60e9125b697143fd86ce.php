<?php if(count($datas)>0): ?>
  <div class="panel-process">
    <span id="img-title" class="basket_ing"></span>
    <label id="label-title">Olah Bahan Baku</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Bahan Baku" title="Mencari data Bahan Baku"/></div>
  </div>
  <div class="wrap-table">
      <table id='data-table' class="data-table ingredient">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Bahan</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Proses</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
          ?>
          <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
              if($data->jumlah==null){
                $jum = 0;
              }else{
                $jum = $data->jumlah;
              }
             ?>
            <tr>
              <td><?php echo e($i++); ?></td>
              <td><?php echo e($data->nama); ?></td>
              <td><?php echo e($jum); ?></td>
              <td><?php echo e($data->ket); ?></td>
              <?php 
                $datetime1 = new DateTime($data->kadaluarsa);
                $datetime2 = new DateTime($nowdate);
                $difference = $datetime1->diff($datetime2);
                $bedahari = $difference->days;
                if($datetime2>$datetime1){
                  $bedahari = -1 * $bedahari;
                }
               ?>
              <?php if(($bedahari<=7)&&($bedahari>0)): ?>
                <td title="<?php echo e($data->jum); ?> bahan"><?php echo e($bedahari); ?> hari lagi</td>
              <?php elseif(($bedahari<=0)&&($data->kadaluarsa!=null)): ?>
                <td title="<?php echo e($data->jum); ?> bahan">Sudah Kadaluarsa</td>
              <?php elseif($data->kadaluarsa!=null): ?>
                <td title="<?php echo e($data->jum); ?> bahan"><?php echo e($data->kadaluarsa); ?></td>
              <?php else: ?>
                <td>Tanggal Belum diatur</td>
              <?php endif; ?>
              <td><button onclick="edit_ing(<?php echo e($data->no); ?>)" class="whiteedit prosesbtn green" type="button">Edit</button></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <input type="hidden" id="tempchange">
  </div>
<?php else: ?>
 <center>
  <?php if(($status==1)||($status==3)): ?>
     <div class="not-found">
       <?php if($pesan): ?>
         <?php echo e($pesan); ?>

       <?php elseif($status==1): ?>
         Tidak ada data hidangan !
       <?php else: ?>
         Tidak ada data bahan baku !
       <?php endif; ?>
       <br>
       <?php if($status==1): ?>
         <button type="button" onclick="add_new(0)" class="new prosesbtn green" name="button">Klik untuk tambah data</button>
       <?php else: ?>
         <button type="button" onclick="add_new(1)" class="new prosesbtn green" name="button">Klik untuk tambah data</button>
       <?php endif; ?>
     </div>
  <?php else: ?>
    <div class="not-found">
      <?php echo e($pesan); ?>

    </div>
  <?php endif; ?>
 </center>
<?php endif; ?>
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
