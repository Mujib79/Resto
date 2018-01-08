@if (count($datas)>0)
  <div class="panel-process">
    <span id="img-title"></span>
    @php
      if (count($status)>0){
          $title = "Semua Laporan";
          echo "<script>$('#img-title').addClass('all-data');</script>";
      }else{
          $title = "Sampah Laporan";
          echo "<script>$('#img-title').addClass('whitetrash');</script>";
      }
    @endphp
    <label id="label-title">Olah Laporan Belanja | Semua Laporan</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Laporan Belanja" title="Mencari data laporan belanja"/></div>
  </div>
  <div class="wrap-table">
    @if($status==1)
      <div class="option">
        <button type="button" onclick="add_new_report(1)" style="margin-left: 1%;" class="brick plus prosesbtn animasi">Buat Laporan Baru</button>
      </div>
    @endif
    {{-- <form id="serialdata" method="post" role="form" enctype="multipart/form-data">

    </form> --}}
    <table id="data-table" class="data-table tabellaporan">
      <thead>
        <tr>
          <th>Nomor Laporan</th>
          <th>Tanggal Buat</th>
          <th>Anggaran</th>
          <th>Belanja</th>
          <th>Pembuat</th>
          <th colspan="3">Proses</th>
        </tr>
      </thead>
      <tbody id="bodycontent">
          @foreach ($datas as $data)
            <tr title="Terakhir diubah pada: {{$data->update}}">
              <td>{{$data->no_report}}</td>
              <td>{{$data->tanggal}}</td>
              <td>Rp. {{number_format($data->budget,0,',','.')}}</td>
              <td>Rp. {{number_format($data->belanja,0,',','.')}}</td>
              <td>{{$data->nama}}</td>
              @if (count($status)>0)
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
      </tbody>
    </table>
  </div>
@else
  <center>
    <div class="not-found">
      {{$pesan}}
      <br>
      @if (count($status)>0)
        <button type="button" onclick="add_new_report(0)" class="new prosesbtn green" name="button">Klik untuk tambah data</button>
      @endif
    </div>
  </center>
@endif
<script type="text/javascript">
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
