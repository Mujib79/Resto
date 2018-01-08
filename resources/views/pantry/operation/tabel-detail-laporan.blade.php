@if (count($datas)>0)
  @php
  $i = 1;
  @endphp
  @if (count($reports)>0)
    @foreach ($reports as $report)
    @endforeach
    @foreach ($datas as $data)
      <tr>
        <td><input type="checkbox" value="{{$data->no_detail}}" id="check{{$i}}"></td>
        <td>
          <input type="text" id="namabahan" onkeyup="search_ing(this)" list="listsearch" onblur="save_detail(this,{{$data->no_detail}},{{$report->no_report}},0)" value="{{$data->nama_bahan}}">
        </td>
        <td><input id="hrgsatuan{{$i}}" type="number" onblur="save_detail(this,{{$data->no_detail}},{{$report->no_report}},1)" onchange="hitung_total(this,{{$i}})" onkeyup="just_number(this);hitung_total(this,{{$i}})" step="500" min="0" value="{{$data->satuan}}"></td>
        <td><input id="qty{{$i}}" type="number" onblur="save_detail(this,{{$data->no_detail}},{{$report->no_report}},2)" onchange="hitung_total(this,{{$i}})" onkeyup="just_number(this);hitung_total(this,{{$i++}})" min="0" value="{{$data->jumlah}}"></td>
        <td>Rp. {{number_format($data->satuan*$data->jumlah,0,',','.')}}</td>
        <td><input type="text" onblur="save_keterangan(this,{{$data->no_detail}},{{$report->no_report}})" value="{{$data->keterangan}}"></td>
      </tr>
    @endforeach
  @else
      @foreach ($datas as $data)
        <tr>
          <td><input type="checkbox" onclick="temp_data({{$i}},this,1)" value="{{$data->no_detail}}" id="check{{$i}}"></td>
          <td>
            <input type="text" id="namabahan" onkeyup="search_ing(this)" list="listsearch" onblur="save_detail(this,{{$data->no_detail}},{{$no}},0)" value="{{$data->nama_bahan}}">
          </td>
          <td><input id="hrgsatuan{{$i}}" type="number" onblur="save_detail(this,{{$data->no_detail}},{{$no}},1)" onchange="hitung_total(this,{{$i}})" onkeyup="just_number(this);hitung_total(this,{{$i}})" step="500" min="0" value="{{$data->satuan}}"></td>
          <td><input id="qty{{$i}}" type="number" onblur="save_detail(this,{{$data->no_detail}},{{$no}},2)" onchange="hitung_total(this,{{$i}})" onkeyup="just_number(this);hitung_total(this,{{$i++}})" min="0" value="{{$data->jumlah}}"></td>
          <td>Rp. {{number_format($data->satuan*$data->jumlah,0,',','.')}}</td>
          <td><input type="text" onblur="save_keterangan(this,{{$data->no_detail}},{{$no}})" value="{{$data->keterangan}}"></td>
        </tr>
    @endforeach
  @endif
@endif
@if(session()->has('message'))
  <script>
  swal({
    title: "{{session()->get('title')}}",
    text: "{{session()->get('message')}}",
    type: "{{session()->get('type')}}",
    confirmButtonColor: "#2b5dcd",
    confirmButtonText: "OK",
    closeOnConfirm: true
  });
  </script>
  <?php session()->forget('message');?>
@endif
