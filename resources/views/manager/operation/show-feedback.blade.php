@if (count($datas)>0)
  <div class="panel-process">
    <span id="img-title" class="feedback"></span>
    <label id="label-title">Umpan Balik Pelanggan</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Umpan Balik" title="Mencari Umpan Balik"/></div>
  </div>
  <div class="wrap-table">
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
          <button type="button" class="brick animasi paging" id="paging{{$i}}" onclick="paging({{$paging}},'#paging{{$i}}',0)">{{$i}}</button>
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
    <div class="option">
      <button type="button" onclick="delete_row_feedback('temporarycheck')" style="margin-left: 10px;" id="hps" class="green1 prosesbtn blacktrash animasi">Hapus Baris</button>
    </div>
    <form id="temporarycheck" name="temporarycheck" method="post">

    </form>
    <table id="data-table" class="data-table feedbacktbl">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkmaster" onclick="clickAll('data-table')"></th>
          <th>Tanggal</th>
          <th>Perihal</th>
          <th>Konten</th>
        </tr>
      </thead>
      <tbody id="bodycontent">
        @php
          $i=1;
        @endphp
        @foreach ($datas as $data)
          <tr>
            <td><input onclick="temp_data({{$i}},this)" type="checkbox" id="check{{$i}}" value="{{$data->no_pemesanan}}"></td>
            <td onclick="ceklis_tanda({{$i}})">{{$data->tanggal}}</td>
            <td onclick="ceklis_tanda({{$i}})">{{$data->perihal}}</td>
            <td onclick="ceklis_tanda({{$i++}})">{{$data->konten}}</td>
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
