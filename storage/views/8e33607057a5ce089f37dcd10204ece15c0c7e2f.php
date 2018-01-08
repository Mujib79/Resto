<?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="panel-header">
  <button type="button" class="red back prosesbtn animasi" id="simpan" onclick="show('olah-laporan-belanja')" name="button">Kembali</button>
</div>
<div class="panel-ing">
  <span style="margin-right: 25px;font-weight:bold;font-size:20px;">Nomor Laporan : <?php echo e($report->no_report); ?></span>
  <span style="font-weight:bold;font-size:20px;margin-right:25px">Tanggal : <?php echo e($report->tanggal); ?></span>
  <span style="font-weight:bold;font-size:20px;">Anggaran : <input type="number" onblur="save_anggaran(<?php echo e($report->no_report); ?>,this)" step="10000" min="0" onkeyup="just_number(this)" value="<?php echo e($report->budget); ?>"></span>
</div>
<div class="wrap-table" id="editlaporan">
  <div class="option">
    <button type="button" onclick="add_new_row(<?php echo e($report->no_report); ?>,1)" style="margin-left: 1%;" class="brick plus prosesbtn animasi">Tambah Baris</button>
    <button type="button" id="hps" onclick="delete_row(<?php echo e($report->no_report); ?>,1)" style="margin-left: 5px;" class="green1 blacktrash prosesbtn animasi" disabled="disabled">Hapus Baris</button>
  </div>
  <form id="serialdata" method="post" role="form" enctype="multipart/form-data">

  </form>
  <table id="data-table" class="data-table edittabellaporan">
    <thead>
      <tr>
        <th><input type="checkbox" onclick="clickAll('data-table')" id="checkmaster"></th>
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
            <td><input type="checkbox" onclick="temp_data(<?php echo e($i); ?>,this,1)" value="<?php echo e($data->no_detail); ?>" id="check<?php echo e($i); ?>"></td>
            <td>
              <input type="text" id="namabahan" onkeyup="search_ing(this)" list="listsearch" onchange="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($report->no_report); ?>,0)" value="<?php echo e($data->nama_bahan); ?>">
            </td>
            <td><input type="number" id="hrgsatuan<?php echo e($i); ?>" onblur="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($report->no_report); ?>,1)" onchange="hitung_total(this,<?php echo e($i); ?>)" onkeyup="just_number(this);hitung_total(this,<?php echo e($i); ?>)"  step="500" min="0" value="<?php echo e($data->satuan); ?>"></td>
            <td><input type="number" id="qty<?php echo e($i); ?>" onblur="save_detail(this,<?php echo e($data->no_detail); ?>,<?php echo e($report->no_report); ?>,2)" onchange="hitung_total(this,<?php echo e($i); ?>)" onkeyup="just_number(this);hitung_total(this,<?php echo e($i++); ?>)"  min="0" value="<?php echo e($data->jumlah); ?>"></td>
            <td>Rp. <?php echo e(number_format($data->satuan*$data->jumlah,0,',','.')); ?></td>
            <td><input type="text" onblur="save_keterangan(this,<?php echo e($data->no_detail); ?>,<?php echo e($report->no_report); ?>)" value="<?php echo e($data->keterangan); ?>"></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    </tbody>
  </table>
  <datalist id="listsearch">

  </datalist>
</div>
