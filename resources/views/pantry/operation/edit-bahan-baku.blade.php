<script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
</script>
@foreach ($ings as $ing)
@endforeach
<div class="panel-header">
  <button type="button" class="red back prosesbtn animasi" id="simpan" onclick="show('olah-bahan-baku')" name="button">Kembali</button>
</div>
<div class="panel-ing">
  <span style="margin-right: 25px;font-weight:bold;font-size:20px;">Nama Bahan : {{$ing->nama}}</span>
  <span style="font-weight:bold;font-size:20px;">Satuan : <input type="text" onchange="save_data('satuan',{{$ing->no}},'',this)" id="satuan" value="{{$ing->satuan}}"></span>
</div>
<div style="height: calc(100vh - 182px);" class="wrap-table">
  <div class="option">
    <button type="button" onclick="add_new_row({{$ing->no}},0)" style="margin-left: 1%;" class="brick plus prosesbtn animasi">Tambah Baris</button>
    <button type="button" id="hps" onclick="delete_row({{$ing->no}},0)" style="margin-left: 5px;" class="green1 blacktrash prosesbtn animasi" disabled="disabled">Hapus Baris</button>
  </div>
  <form id="serialdata" method="post" role="form" enctype="multipart/form-data">

  </form>
  <table id="headtbldetail" class="data-table">
    <thead>
      <tr>
        <th rowspan="2"><input type="checkbox" onclick="clickAll('headtbldetail')" id="checkmaster"></th>
        <th colspan="3">Tanggal</th>
        <th rowspan="2">Jumlah</th>
        <th rowspan="2">Keterangan</th>
      </tr>
      <tr>
        <th>Beli</th>
        <th>Produksi</th>
        <th>Kadaluarsa</th>
      </tr>
    </thead>
    <tbody id="tbodydetail">
      @php
        $i=1;
      @endphp
      @foreach ($details as $detail)
        <tr>
          <td><input onclick="temp_data({{$i}},this,1)" type="checkbox" value="{{$detail->no}}" id="check{{$i}}"></td>
          <td><input onchange="save_data('tgl_beli',{{$ing->no}},{{$detail->no}},this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_beli{{$i}}" id="tgl_beli{{$i}}" value="{{$detail->tgl_beli}}" readonly></td>
          <td><input onchange="save_data('tgl_produksi',{{$ing->no}},{{$detail->no}},this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_produksi{{$i}}" id="tgl_produksi{{$i}}" value="{{$detail->tgl_produksi}}" readonly></td>
          <td><input onchange="save_data('tgl_kadaluarsa',{{$ing->no}},{{$detail->no}},this)" style="cursor:pointer" class="datepicker date inpdate" type="text" name="tgl_kadaluarsa{{$i}}" id="tgl_kadaluarsa{{$i++}}" value="{{$detail->tgl_kadaluarsa}}" readonly></td>
          <td><input onchange="save_data('jumlah',{{$ing->no}},{{$detail->no}},this)" onblur="save_data('jumlah',{{$ing->no}},{{$detail->no}},this)" min=0 type="number" onkeyup="just_number(this)" name="jumlah" id="jumlah" value="{{$detail->jumlah}}"></td>
          <td><input onchange="save_data('keterangan',{{$ing->no}},{{$detail->no}},this)" type="text" name="jumlah" id="jumlah" value="{{$detail->ket}}"></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
