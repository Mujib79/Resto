@if (count($datas_tbl)>0)
  @php
    $i=1;
  @endphp
  @foreach ($datas_tbl as $datatbl)
    @php
      if ($datatbl->status==1) {
        $stsclass = "available1";
      }else{
        $stsclass = "notavailable1";
      }
    @endphp
    <tr>
      <td><input onclick="temp_data({{$i}},this,0)" type="checkbox" id="check{{$i}}" value="{{$datatbl->no}}"></td>
      <td>{{$i++}}</td>
      <td>{{$datatbl->nama}}</td>
      <td class="{{$stsclass}} stsfood"></td>
    </tr>
  @endforeach
@endif
