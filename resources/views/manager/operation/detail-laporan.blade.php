@foreach ($reports as $report)
@endforeach
<div class="panel-header">
  <button type="button" class="red back prosesbtn animasi" id="kembali" onclick="sort_data('pengeluaran')" name="button">Kembali</button>
  <button type="button" style="margin-left: 10px;" class="backup brick prosesbtn animasi" title="Backup data" onclick="backup_pengeluaran({{$report->no_report}})">Backup</button>
</div>
<div class="panel-ing">
  <span style="margin-right: 25px;font-weight:bold;font-size:20px;">Nomor Laporan : {{$report->no_report}}</span>
  <span style="font-weight:bold;font-size:20px;margin-right:25px">Tanggal : {{$report->tanggal}}</span>
  <span style="font-weight:bold;font-size:20px;margin-right:25px">Anggaran : Rp. {{number_format($report->budget,0,',','.')}}</span>
  <span style="font-weight:bold;font-size:20px;">Total Belanja : Rp. {{number_format($report->total,0,',','.')}}</span>
</div>
<div class="wrap-table" id="editlaporan">
  <table id="data-table" class="data-table edittabellaporan">
    <thead>
      <tr>
        <th>Nomor</th>
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
            <td>{{$i++}}</td>
            <td>{{$data->nama_bahan}}</td>
            <td>Rp. {{number_format($data->satuan,0,',','.')}}</td>
            <td>{{$data->jumlah}}</td>
            <td>Rp. {{number_format($data->satuan*$data->jumlah,0,',','.')}}</td>
            <td>{{$data->keterangan}}</td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
  <datalist id="listsearch">

  </datalist>
</div>
