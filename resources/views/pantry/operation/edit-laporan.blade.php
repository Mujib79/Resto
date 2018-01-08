@foreach ($reports as $report)
@endforeach
<div class="panel-header">
  <button type="button" class="red back prosesbtn animasi" id="simpan" onclick="show('olah-laporan-belanja')" name="button">Kembali</button>
</div>
<div class="panel-ing">
  <span style="margin-right: 25px;font-weight:bold;font-size:20px;">Nomor Laporan : {{$report->no_report}}</span>
  <span style="font-weight:bold;font-size:20px;margin-right:25px">Tanggal : {{$report->tanggal}}</span>
  <span style="font-weight:bold;font-size:20px;">Anggaran : <input type="number" onblur="save_anggaran({{$report->no_report}},this)" step="10000" min="0" onkeyup="just_number(this)" value="{{$report->budget}}"></span>
</div>
<div class="wrap-table" id="editlaporan">
  <div class="option">
    <button type="button" onclick="add_new_row({{$report->no_report}},1)" style="margin-left: 1%;" class="brick plus prosesbtn animasi">Tambah Baris</button>
    <button type="button" id="hps" onclick="delete_row({{$report->no_report}},1)" style="margin-left: 5px;" class="green1 blacktrash prosesbtn animasi" disabled="disabled">Hapus Baris</button>
  </div>
  <form id="serialdata" method="post" role="form" enctype="multipart/form-data">

  </form>
  <table id="data-table" class="data-table edittabellaporan">
    <thead>
      <tr>
        <th><input type="checkbox" onclick="clickAll('data-table')" id="checkmaster"></th>
        <th>Nama Bahan</th>
        <th>Harga Satuan</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody id="tbodydetail">
      @if (count($datas)>0)
        @php
          $i = 1;
        @endphp
        @foreach ($datas as $data)
          <tr>
            <td><input type="checkbox" onclick="temp_data({{$i}},this,1)" value="{{$data->no_detail}}" id="check{{$i}}"></td>
            <td>
              <input type="text" id="namabahan" onkeyup="search_ing(this)" list="listsearch" onchange="save_detail(this,{{$data->no_detail}},{{$report->no_report}},0)" value="{{$data->nama_bahan}}">
            </td>
            <td><input type="number" id="hrgsatuan{{$i}}" onblur="save_detail(this,{{$data->no_detail}},{{$report->no_report}},1)" onchange="hitung_total(this,{{$i}})" onkeyup="just_number(this);hitung_total(this,{{$i}})"  step="500" min="0" value="{{$data->satuan}}"></td>
            <td><input type="number" id="qty{{$i}}" onblur="save_detail(this,{{$data->no_detail}},{{$report->no_report}},2)" onchange="hitung_total(this,{{$i}})" onkeyup="just_number(this);hitung_total(this,{{$i++}})"  min="0" value="{{$data->jumlah}}"></td>
            <td>Rp. {{number_format($data->satuan*$data->jumlah,0,',','.')}}</td>
            <td><input type="text" onblur="save_keterangan(this,{{$data->no_detail}},{{$report->no_report}})" value="{{$data->keterangan}}"></td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
  <datalist id="listsearch">

  </datalist>
</div>
