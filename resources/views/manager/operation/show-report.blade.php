@if (count($datas)>0)
  <div class="panel-process">
    <span id="img-title" class="spending"></span>
    <label id="label-title">Pengeluaran | Belanja Bahan Baku</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Pemasukan" title="Mencari pemasukan"/></div>
  </div>
  <div class="wrap-table">
    @if(count($counts)>0)
      @foreach ($counts as $count)
      @endforeach
      @if ($count->jum>=15)
        <div class="panelpaging">
          @php
          $jumbtn = intval($count->jum/15);
          if($count->jum % 15!=0){
            $jumbtn++;
          }
          $paging = 0;
          echo "Halaman: ";
          for ($i=1;$i<=$jumbtn;$i++) {
            @endphp
            <button type="button" class="brick animasi paging" id="paging{{$i}}" onclick="paging({{$paging}},'#paging{{$i}}',1)">{{$i}}</button>
            @php
            $paging = $paging + 15;
          }
          @endphp
          <input type="hidden" id="temppaging" value="#paging1">
          <script type="text/javascript">
            $("#paging1").toggleClass("activepaging");
          </script>
        </div>
      @endif
    @endif
    <table id="data-table" class="data-table tabellaporan">
      <thead>
        <tr>
          <th>Nomor Laporan</th>
          <th>Tanggal Buat</th>
          <th>Anggaran</th>
          <th>Belanja</th>
          <th>Pembuat</th>
          <th colspan="2">Proses</th>
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
              <td><button onclick="detail_data({{$data->no_report}})" class="green" type="button">Detail</button></td>
              <td><button onclick="delete_data({{$data->no_report}},1)" class="whitetrash prosesbtn red" type="button">Hapus</button></td>
            @else
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
    </div>
  </center>
@endif
<script type="text/javascript">
$("#{{$id}}").addClass("active-child");
$("#tempid").val("{{"#$id"}}");
</script>
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
