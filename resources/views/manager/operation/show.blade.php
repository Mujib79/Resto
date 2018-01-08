@if (count($datas)>0)
  <div class="panel-process">
    <span id="img-title"></span>
    <label id="label-title"></label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Pemasukan" title="Mencari pemasukan"/></div>
  </div>
  <div class="wrap-table">
      <div class="option">
        <input type="hidden" id="temptahunan" value="<?php echo date('Y') ?>">
        @if ($id!="tahunan")
          <label>Cari pemasukan pada:</label>
          @if(($id=="harian")||($id=="bulanan"))
            @if ($id=="harian")
              <input type="hidden" id="tempbulanan" value="<?php echo date('m') ?>">
              <select id="bulan">
                <option value="">Pilih Bulan</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
              <script type="text/javascript">
                document.getElementById("bulan").value = "<?php echo date('m') ?>";
              </script>
            @endif
            <select id="tahun">
              <option value="">Pilih Tahun</option>
              @foreach ($years as $year)
                <option value="{{$year->tahun}}">{{$year->tahun}}</option>
              @endforeach
            </select>
            <script type="text/javascript">
              document.getElementById("tahun").value = "<?php echo date('Y') ?>";
            </script>
          @endif
          <button type="button" class="whiteproses prosesbtn green animasi" onclick="sort_proses()">Proses</button>
        @endif
        <button type="button" style="margin-left: 10px;" class="backup brick prosesbtn animasi" title="Backup data" onclick="backup('{{$id}}')">Backup</button>
      </div>
    <table id="data-table" class="data-table tabel-pemasukan">
      <thead>
        <tr>
          <th>Nomor</th>
          <th>Tanggal</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody id="bodycontent">
        @php
          $i=1;
        @endphp
        @foreach ($datas as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->tanggal}}</td>
            <td>Rp. {{number_format($data->total,0,',','.')}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    switch ("{{$id}}") {
      case "harian" : imgtitle = "dayincome";ket="Pemasukan | Harian";
      break;
      case "bulanan" : imgtitle = "monthincome";ket="Pemasukan | Bulanan";
      break;
      case "tahunan" : imgtitle = "yearincome";ket="Pemasukan | Tahunan";
      break;
      case "pengeluaran" : imgtitle = "spending";ket="Pengeluaran | Belanja Bahan Baku";
      break;
    }
    $("#img-title").addClass(imgtitle);
    $("#label-title").html(ket);
  </script>
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
