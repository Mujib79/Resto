@if (count($datalists)>0)
  @foreach ($datalists as $datalist)
    <option value="{{$datalist->nama}}">{{$datalist->nama}}</option>
  @endforeach
@endif
