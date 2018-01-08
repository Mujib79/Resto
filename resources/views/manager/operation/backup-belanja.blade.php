@foreach ($reports as $report)
@endforeach
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{!! asset('public/css/backup.css') !!}">
  </head>
  <body>
    <center>
      <h1>Laporan Belanja Bahan Baku</h1>
    </center>
    <hr>
    <table style="width: 100%;">
      <thead>
        <tr>
          <th>Nomor Laporan</th>
          <th>Tanggal Buat</th>
          <th>Anggaran</th>
          <th>Belanja</th>
          <th>Pembuat</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$report->no_report}}</td>
          <td>{{$report->tanggal}}</td>
          <td>Rp. {{number_format($report->budget,0,',','.')}}</td>
          <td>Rp. {{number_format($report->belanja,0,',','.')}}</td>
          <td>{{$report->nama}}</td>
        </tr>
      </tbody>
    </table>
    <br>
    <b>Detail Belanja:</b>
    <table style="width:100%" class="belanjadetail">
      <thead>
        <tr>
          <th>Nomor</th>
          <th>Nama Bahan</th>
          <th>Harga Satuan</th>
          <th>Jumlah</th>
          <th>Keterangan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        @php
          $i=1;
        @endphp
        @foreach ($datas as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->nama_bahan}}</td>
            <td>Rp. {{number_format($data->satuan,0,',','.')}}</td>
            <td>{{$data->jumlah}}</td>
            <td>{{$data->keterangan}}</td>
            <td>Rp. {{number_format(($data->jumlah * $data->satuan),0,',','.')}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
