@if (count($datas)>0)
  <div class="panel-process">
    <span id="img-title"></span>
    <label id="label-title"></label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Hidangan" title="Mencari data hidangan"/></div>
  </div>
  <div class="wrap-table">
    @if ($status==2)
      <div class="option">
        <label>Ubah Menjadi {{$confmessage}}Tersedia    :</label>
        <button type="button" onclick="conf_visibility('temporarycheck',{{$novisib}},'{{$visib}}','koki')" class="green whiteproses prosesbtn animasi" name="notavailablebtn">Proses</button>
      </div>
      <table id='data-table' class="data-table visibility">
        <thead>
          <tr>
            <th><input type="checkbox" onclick="checkAll('data-table','check')" name="checkMaster" id="checkMaster"></th>
            <th>Nama Hidangan</th>
            <th>Jenis Hidangan</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=0;
          ?>
          @foreach ($datas as $data)
          <?php
            switch ($data->kode) {
              case 'MAC':
                $jenis = "Hidangan Utama";
              break;
              case 'APP':
                $jenis = "Hidangan Pembuka";
              break;
              case 'DES':
                $jenis = "Hidangan penutup";
              break;
              case 'SOF':
                $jenis = "Minuman";
              break;
            }
            ?>
            <tr>
              <td  class="animasi"><input onclick="check_row('check<?php echo $i?>',1)" type="checkbox" id="check<?php echo $i?>" value="{{$data->no}}"></td>
              <td  class="animasi" onclick="check_row('check<?php echo $i?>',0)">{{$data->nama}}</td>
              <td  class="animasi" onclick="check_row('check<?php echo $i?>',0)">{{$jenis}}</td>
              <td  class="animasi" onclick="check_row('check<?php echo $i++?>',0)" class="number">Rp. {{number_format($data->harga,0,',','.')}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <form id="temporarycheck" name="temporarycheck" method="post">

      </form>
    @elseif (($status==1 || $status==0)&&($id!="ALL"))
      <table id='data-table' class="data-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Hidangan</th>
            <th>Harga</th>
            <th colspan=2>Proses</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
          ?>
          @foreach ($datas as $field => $data)
            <tr>
              <td><?php echo $i++ ?></td>
              <td>{{$data->nama}}</td>
              <td class="number">Rp. {{number_format($data->harga,0,',','.')}}</td>
              @if ($status==0)
                <td style="text-align:center"><button onclick="restore({{$data->no}},0)" class="restore prosesbtn green" type="button">Restore</button></td>
                <td><button onclick="permanen_delete({{$data->no}},'{{$data->nama}}',0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
              @else
                <td style="text-align:center"><button onclick="edit_data({{$data->no}},0)" class="whiteedit prosesbtn green" type="button">Edit</button></td>
                <td><button onclick="delete_data({{$data->no}},'{{$data->nama}}',0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
              @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    @elseif ($id=="ALL")
      <table id='data-table' class="data-table tableall">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Hidangan</th>
            <th>Jenis Hidangan</th>
            <th>Harga</th>
            <th colspan=2>Proses</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
          ?>
          @foreach ($datas as $field => $data)
          <?php
            switch ($data->kode) {
              case 'MAC':
                $jenis = "Hidangan Utama";
              break;
              case 'APP':
                $jenis = "Hidangan Pembuka";
              break;
              case 'DES':
                $jenis = "Hidangan penutup";
              break;
              case 'SOF':
                $jenis = "Minuman";
              break;
            }
            ?>
            <tr>
              <td><?php echo $i++ ?></td>
              <td>{{$data->nama}}</td>
              <td>{{$jenis}}</td>
              <td class="number">Rp. {{number_format($data->harga,0,',','.')}}</td>
              @if ($status==0)
                <td><button onclick="restore({{$data->no}},0)" class="restore prosesbtn green" type="button">Restore</button></td>
                <td><button onclick="permanen_delete({{$data->no}},'{{$data->nama}}',0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
              @else
                <td><button onclick="edit_data({{$data->no}},0)" class="whiteedit prosesbtn green" type="button">Edit</button></td>
                <td><button onclick="delete_data({{$data->no}},'{{$data->nama}}',0)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
              @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <script type="text/javascript">
        $("#shsearch input").attr("placeholder","Cari Bahan Baku");
      </script>
      <table id='data-table' class="data-table ingredient">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Bahan</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th colspan=2>Proses</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
          ?>
          @foreach ($datas as $field => $data)
            <tr>
              <td><?php echo $i++ ?></td>
              <td>{{$data->nama_bahan}}</td>
              <td class="number">{{$data->jumlah}}</td>
              <td>{{$data->keterangan}}</td>
              @if ($status!=3)
                <td><button onclick="restore({{$data->no_bahan}},1)" class="restore prosesbtn green" type="button"><label>Restore</label></button></td>
                <td><button onclick="permanen_delete({{$data->no_bahan}},'{{$data->nama_bahan}}',1)" class="whitetrash prosesbtn red" type="button"><label>Hapus</label></button></td>
              @else
                <td><button onclick="popup_edit_ing({{$data->no_bahan}},'{{$data->nama_bahan}}')" class="whiteedit prosesbtn green" type="button"><label>Edit</label></button></td>
                <td><button onclick="delete_data({{$data->no_bahan}},'{{$data->nama_bahan}}',1)" class="whitetrash prosesbtn red" type="button"><label>Hapus</label></button></td>
              @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
@else
 <center>
  @if (($status==1)||($status==3))
     <div class="not-found">
       @if ($pesan)
         {{$pesan}}
       @elseif ($status==1)
         Tidak ada data hidangan !
       @else
         Tidak ada data bahan baku !
       @endif
       <br>
       @if ($status==1)
         <button type="button" onclick="add_new(0)" class="new prosesbtn green" name="button">Klik untuk tambah data</button>
       @else
         <button type="button" onclick="add_new(1)" class="new prosesbtn green" name="button">Klik untuk tambah data</button>
       @endif
     </div>
  @else
    <div class="not-found">
      {{$pesan}}
    </div>
  @endif
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
<script type="text/javascript">
  $("#{{$id}}").addClass("active-child");
  document.getElementById("tempid").value = "#{{$id}}";
  switch("{{$id}}"){
    case 'ALL': ket = "Seluruh Hidangan";ket1 = "Tampilkan Hidangan";ket2="allfood";break;
    case 'APP': ket = "Hidangan Pembuka";ket1 = "Tampilkan Hidangan";ket2="app";break;
    case 'MAC': ket = "Hidangan Utama";ket1 = "Tampilkan Hidangan";ket2="mac";break;
    case 'DES': ket = "Hidangan Penutup";ket1 = "Tampilkan Hidangan";ket2="des";break;
    case 'SOF': ket = "Minuman";ket1 = "Tampilkan Hidangan";ket2="sof";break;
    case 'trash': ket = "Sampah Hidangan";ket1 = "Olah Data Hidangan";ket2="trash";break;
    case 'trashing': ket = "Sampah Bahan Baku";ket1 = "Olah Bahan Baku";ket2="trash";break;
    case 'shing': ket = "Lihat Bahan Baku";ket1 = "Olah Bahan Baku";ket2="basket";break;
    case 'available': ket = "Tersedia";ket1 = "Olah Ketersediaan Hidangan";ket2="available";break;
    case 'notavailable': ket = "Tidak Tersedia";ket1 = "Olah Ketersediaan Hidangan";ket2="notavailable";break;
  }
  document.getElementById("label-title").innerHTML = ket1+" | "+ket;
  $("#img-title").addClass(ket2);
</script>
