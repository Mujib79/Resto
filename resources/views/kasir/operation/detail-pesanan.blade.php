@if (count($datas)>0)
  @foreach ($datas as $data)
    <tr>
      <td>{{$data->nama}}</td>
      <td>{{$data->qty}}</td>
      <td>Rp. {{number_format($data->harga,0,',','.')}}</td>
      <td>Rp. {{number_format($data->harga*$data->qty,0,',','.')}}</td>
    </tr>
  @endforeach
@endif
