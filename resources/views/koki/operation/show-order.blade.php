<table class="data-table">
  <thead>
    <tr>
      <th>Nomor Meja</th>
      <th>Jumlah Pesan</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datas as $data)
      <tr onclick="show_detail({{$data->nopesan}})">
        <td>{{$data->no_meja}}</td>
        <td>{{$data->jum}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
