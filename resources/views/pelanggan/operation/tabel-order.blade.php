@if(count($datas)>0)
  @php
    $i=1;
    $hitung = 0;
    $jumpesan = 0;
    $jumlah = 0;
  @endphp
  @foreach ($datas as $data)
    <tr>
      <td>{{$i++}}</td>
      <td>{{$data->nama}}</td>
      <td id="harga{{$data->notrans}}" data-value="{{$data->harga}}">Rp. {{number_format($data->harga,0,',','.')}}</td>
      @if ($data->sts == 0)
        <td><input type="number" value="{{$data->jml}}" onfocus="clearInterval(loadinterval);this.select()"  onchange="simpan_jumlah({{$data->notrans}},this)" onblur="simpan_jumlah({{$data->notrans}},this);loadinterval = setInterval('load_keranjang()',3000)" onkeyup="justnumber(this);hitung_total({{$data->notrans}},this.value);" min=1></td>
      @else
        <td> {{ $data->jml }}</td>
      @endif
      <td id="total{{$data->notrans}}">Rp. {{number_format(($data->harga*$data->jml),0,',','.')}}</td>
      @php
        $jumlah = $jumlah + $data->jml;
        $hitung = $hitung + ($data->harga * $data->jml);
        switch ($data->sts) {
          case 0:$sts = "Belum dipesan";break;
          case 1:$sts = "Dipesan";break;
          case 2:$sts = "Dibuat";break;
          case 3:$sts = "Selesai";$jumpesan++;break;
          case 4:$sts = "Tidak dapat dibuat";
              session()->flash('title','Pemberitahuan');
              session()->flash('type','info');
              session()->flash('message',"Hidangan $data->nama tidak dapat dibuat karena beberapa alasan, hidangan ini akan dihapus secara otomatis dari keranjang belanja anda, mohon maaf atas ketidaknyamanannya");
          break;
        }

      @endphp
      <td>{{$sts}}</td>
      @if ($data->sts==0)
        <td><a href="#" class="iconprosesorder memo animasi" onclick="get_catatan({{$data->notrans}});popup('catatan',1)" type="button" id="catatan{{$data->notrans}}"></a></td>
        <td><a href="#" class="blacktrash iconprosesorder animasi" type="button" id="hapus{{$data->notrans}}" onclick="hapus_transaksi({{$data->notrans}})"></a></td>
      @else
        <td>-</td>
        <td>-</td>
      @endif
      @if($data->sts == 4)
        <script type="text/javascript">
          hapus_transaksi({{$data->notrans}});
        </script>
      @endif
    </tr>
  @endforeach

  <script type="text/javascript">
    if({{$jumlah}}>0){
      $("#notification").css("display","block");
      stop_interval();
      start_interval();
    }
    $("#notification").html({{$jumlah}});
    $("#hitungbelanja").html("Rp. {{number_format($hitung,0,',','.')}}");
    $("#tempjum").val({{$i-1}});
    $("#temppesan").val({{$jumpesan}});
  </script>
@else
  <script type="text/javascript">
    stop_interval();
    $("#notification").css("display","none");
    $("#notification").html("0");
    $("#hitungbelanja").html("Rp. 0");
    $("#tempjum").val(0);
    $("#temppesan").val(0);
  </script>
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
