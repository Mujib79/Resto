@php
  $i=1;
@endphp
@foreach ($datas as $data)
  <tr>
    <td><input onclick="temp_data({{$i}},this)" type="checkbox" id="check{{$i}}" value="{{$data->no_pemesanan}}"></td>
    <td onclick="ceklis_tanda({{$i}})">{{$data->tanggal}}</td>
    <td onclick="ceklis_tanda({{$i}})">{{$data->perihal}}</td>
    <td onclick="ceklis_tanda({{$i++}})">{{$data->konten}}</td>
  </tr>
@endforeach
