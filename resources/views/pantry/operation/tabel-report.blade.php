@if (count($datas)>0)
  @foreach ($datas as $data)
    <tr title="Terakhir diubah pada: {{$data->update}}">
      <td>{{$data->no_report}}</td>
      <td>{{$data->tanggal}}</td>
      <td>Rp. {{number_format($data->budget,0,',','.')}}</td>
      <td>Rp. {{number_format($data->belanja,0,',','.')}}</td>
      <td>{{$data->nama}}</td>
      @if ($status==1)
        <td><button onclick="kirim({{$data->no_report}})" class="blackupload prosesbtn brick" type="button" title="Mengirim laporan ke manager">Kirim</button></td>
        <td><button onclick="edit_data({{$data->no_report}})" class="whiteedit prosesbtn green" type="button">Edit</button></td>
        <td><button onclick="delete_data({{$data->no_report}},1)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
      @else
        <td><button class="blackupload prosesbtn brick" type="button" title="Mengirim laporan ke manager" disabled="disabled">Kirim</button></td>
        <td><button onclick="restore_laporan({{$data->no_report}})" class="restore prosesbtn green" type="button">Restore</button></td>
        <td><button onclick="delete_data({{$data->no_report}},0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
      @endif
    </tr>
  @endforeach
@endif
<script>
@if(session()->has('message'))
  swal({
    title: "{{session()->get('title')}}",
    text: "{{session()->get('message')}}",
    type: "{{session()->get('type')}}",
    confirmButtonColor: "#2b5dcd",
    confirmButtonText: "OK",
    closeOnConfirm: true
  });
  <?php session()->forget('message');?>
@endif
</script>
