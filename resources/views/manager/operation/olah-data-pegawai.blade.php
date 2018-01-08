@if (count($datas)>0)
  <div class="panel-process">
    <span id="img-title" class="employee"></span>
    <label id="label-title">Olah Data Pegawai</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Pegawai" title="Mencari data pegawai"/></div>
  </div>
  <div class="wrap-table">
    <div class="option">
      <button type="button" onclick="popup('addemployee',1)" style="background-size:30px;padding-left:44px;" class="new green prosesbtn animasi">Tambah Pegawai</button>
    </div>
    <table id="data-table" class="data-table">
      <thead>
        <tr>
          <th>No</th>
          <th>NIP</th>
          <th>Nama Pegawai</th>
          <th>Jabatan</th>
          <th>Tanggal Masuk</th>
          <th colspan="2">Proses</th>
        </tr>
      </thead>
      <tbody id="bodycontent">
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
            <td><button type="button" onclick="editpegawai('{{$data->NIP}}')" class="whiteedit prosesbtn green animasi">Edit</button></td>
            <td><button type="button" onclick="hapuspegawai('{{$data->NIP}}','{{$data->nama}}')" class="whitetrash prosesbtn red animasi">Hapus</button></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@else
  <center>
    <div class="not-found">
      {{$pesan}}
      <br>
      <button type="button" style="background-size:30px;padding-left:44px;" class="new green prosesbtn animasi" onclick="popup('addemployee',1)">Tambah Pegawai</button>
    </div>
  </center>
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
