@if(count($datas)>0)
  @foreach ($datas as $data)
    <tr onclick="detail_pesan({{$data->no}},{{$data->no_meja}},this)">
      <td>{{$data->no_meja}}</td>
      <td data-value="{{$data->total}}">Rp. {{number_format($data->total,0,',','.')}}</td>
    </tr>
  @endforeach
@endif
