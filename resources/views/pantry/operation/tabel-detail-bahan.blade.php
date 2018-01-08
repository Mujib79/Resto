@php
  $i=1;
@endphp
@foreach ($details as $detail)
  <tr>
    <td><input onclick="temp_data({{$i}},this,1)" type="checkbox" value="{{$detail->no}}" id="check{{$i}}"></td>
    <td><input onchange="save_data('tgl_beli',{{$no}},{{$detail->no}},this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_beli{{$i}}" id="tgl_beli{{$i}}" value="{{$detail->tgl_beli}}" readonly></td>
    <td><input onchange="save_data('tgl_produksi',{{$no}},{{$detail->no}},this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_produksi{{$i}}" id="tgl_produksi{{$i}}" value="{{$detail->tgl_produksi}}" readonly></td>
    <td><input onchange="save_data('tgl_kadaluarsa',{{$no}},{{$detail->no}},this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_kadaluarsa{{$i}}" id="tgl_kadaluarsa{{$i++}}" value="{{$detail->tgl_kadaluarsa}}" readonly></td>
    <td><input onblur="save_data('jumlah',{{$no}},{{$detail->no}},this)" onchange="save_data('jumlah',{{$ing->no}},{{$detail->no}},this)"  min=0 type="number" onkeyup="just_number(this)" name="jumlah" id="jumlah" value="{{$detail->jumlah}}"></td>
    <td><input onchange="save_data('keterangan',{{$no}},{{$detail->no}},this)" type="text" name="jumlah" id="jumlah" value="{{$detail->ket}}"></td>
  </tr>
@endforeach
<script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
</script>
