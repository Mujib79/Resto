@if (count($datas)>0)
  <html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="{!! asset('public/css/backup.css') !!}">
    </head>
    <body>
      <center>
        <h1>Pemasukan {{ucfirst($sts)}}</h1>
        <h2>{{$pesan}}</h2>
      </center>
      <hr><br>
      <table class="data-table">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @php
          $i=1;
          @endphp
          @foreach ($datas as $data)
            <tr>
              <td style="text-align:right">{{$i++}}</td>
              <td>{{$data->tanggal}}</td>
              <td>Rp. {{number_format($data->total,0,',','.')}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </body>
  </html>
@endif
