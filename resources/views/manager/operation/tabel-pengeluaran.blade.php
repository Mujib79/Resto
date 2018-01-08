@if(count($datas)>0)
  @foreach ($datas as $data)
    <tr title="Terakhir diubah pada: {{$data->update}}">
      <td>{{$data->no_report}}</td>
      <td>{{$data->tanggal}}</td>
      <td>Rp. {{number_format($data->budget,0,',','.')}}</td>
      <td>Rp. {{number_format($data->belanja,0,',','.')}}</td>
      <td>{{$data->nama}}</td>
    @if (count($status)>0)
      <td><button onclick="detail_data({{$data->no_report}})" class="green" type="button">Detail</button></td>
      <td><button onclick="delete_data({{$data->no_report}},1)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
    @else
      <td><button onclick="restore_laporan({{$data->no_report}})" class="restore prosesbtn green" type="button">Restore</button></td>
      <td><button onclick="delete_data({{$data->no_report}},0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
    @endif
    </tr>
  @endforeach
@else
  <center>
    <div class="not-found">
      {{$pesan}}
    </div>
  </center>
@endif
