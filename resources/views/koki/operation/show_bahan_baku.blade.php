<table id="t_databahan" class="data-table">
  <thead>
    <tr>
      <th>No</th>
      <th colspan=2>Nama Bahan</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1?>
    @foreach ($datas as $key => $data)
      <tr>
        <td><?php echo $i++?></td>
        <td>{{$data->nama_bahan}}</td>
        <td><button onclick="addrow('{{$data->no_bahan}}','{{$data->nama_bahan}}')" class="green animasi" type="button" id="btn{{$data->no_bahan}}">Pilih</button></td>
      </tr>
    @endforeach
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
