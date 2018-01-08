@php
  $i=1;
@endphp
@foreach ($datas as $data)
  <tr>
    <td>{{$i++}}</td>
    <td>{{$data->NIP}}</td>
    <td>{{$data->nama}}</td>
    <td style="text-transform:capitalize">{{strtolower($data->jabatan)}}</td>
    <td>{{$data->masuk}}</td>
    <td><button type="button" class="whiteedit prosesbtn green animasi">Edit</button></td>
    <td><button type="button" onclick="hapuspegawai('{{$data->NIP}}','{{$data->nama}}')" class="whitetrash prosesbtn red animasi">Hapus</button></td>
  </tr>
@endforeach
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
