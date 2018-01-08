<table id="t_databahan" class="data-table">
  <thead>
    <tr>
      <th>No</th>
      <th colspan=2>Nama Bahan</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1?>
    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo $i++?></td>
        <td><?php echo e($data->nama_bahan); ?></td>
        <td><button onclick="addrow('<?php echo e($data->no_bahan); ?>','<?php echo e($data->nama_bahan); ?>')" class="green animasi" type="button" id="btn<?php echo e($data->no_bahan); ?>">Pilih</button></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
<script>
tbl = document.getElementById("t_resep");
if(tbl.rows.length!=0){
  var i;
  for(i=0;i<tbl.rows.length;i++){
    no = tbl.rows[i].cells[0].lastChild.value;
    // alert(no);
    $('#btn'+no).toggleClass("green");
    $('#btn'+no).toggleClass("red");
    $('#btn'+no).html('Hapus');
  }
}
</script>
