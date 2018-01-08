@if(count($datas)>0)
  @php
    $i=1;
  @endphp
  @foreach ($datas as $data)
    <tr>
      <td>{{$i++}}</td>
      <td>{{$data->tanggal}}</td>
      <td>Rp. {{number_format($data->total,0,',','.')}}</td>
    </tr>
  @endforeach
  <script type="text/javascript">
  if($("#tempbulanan")[0]!=null){
    $("#tempbulanan").val($("#bulan").val());
  }
  $("#temptahunan").val($("#tahun").val());
  </script>
@else
  <tr>
    <td colspan="3" style="text-align:center !important;background-color:#fff !important">Data pemasukan tidak ditemukan</td>
  </tr>
  <script type="text/javascript">
  if($("#tempbulanan")[0]!=null){
    $("#tempbulanan").val("");
  }
  $("#temptahunan").val("");
  </script>
@endif
