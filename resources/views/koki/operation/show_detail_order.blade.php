<table id="detailtabel" class="data-table">
  <thead>
    <tr>
      <th>Nama Hidangan</th>
      <th>Jumlah Pesan</th>
      <th colspan="3">Proses</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1 ?>
    @foreach ($datas as $key => $data)
      <tr>
        <td>{{$data->nama}}</td>
        <td>{{$data->jml}}</td>
        <td><button type="button" id="catatan{{$i}}" onclick="tampilkan_pesan('detailtabel',{{$i}})" class="green1 animasi" name="button">Catatan</button></td>
        @if ($data->sts==1)
          <td><button type="button" id="btn{{$i}}" onclick="status_buat({{$data->nopesan}},2,{{$i}},{{$data->notrans}})" class="green animasi" name="button">Buat</button></td>
        @else
          <td><button type="button" id="btn{{$i}}" onclick="status_buat({{$data->nopesan}},3,{{$i}},{{$data->notrans}})" class="green animasi" name="button">Selesai</button></td>
        @endif
        <td style="border:none"><button type="button" onclick="status_buat({{$data->nopesan}},4,{{$i}},{{$data->notrans}})" class="red animasi" name="button">Tolak</button></td>
        <td style="width:0%;display:none;">{{$data->catatan}}</td>
        @if ($data->catatan=="")
          <script type="text/javascript">
          document.getElementById("catatan{{$i}}").disabled = true;
          </script>
        @endif
        @php
          $i++;
        @endphp
      </tr>
    @endforeach
  </tbody>
</table>
