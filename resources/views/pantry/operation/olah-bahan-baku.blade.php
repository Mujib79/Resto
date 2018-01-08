@if (count($datas)>0)
  <div class="panel-process">
    <span id="img-title" class="basket_ing"></span>
    <label id="label-title">Olah Bahan Baku</label>
    <div id="shsearch"><input type="text" class="animasi" onkeyup="search_data(this,'data-table')" placeholder="Cari Bahan Baku" title="Mencari data Bahan Baku"/></div>
  </div>
  <div class="wrap-table">
      <table id='data-table' class="data-table ingredient">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Bahan</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Proses</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
          ?>
          @foreach ($datas as $data)
            @php
              if($data->jumlah==null){
                $jum = 0;
              }else{
                $jum = $data->jumlah;
              }
            @endphp
            <tr>
              <td>{{$i++}}</td>
              <td>{{$data->nama}}</td>
              <td>{{$jum}}</td>
              <td>{{$data->ket}}</td>
              @php
                $datetime1 = new DateTime($data->kadaluarsa);
                $datetime2 = new DateTime($nowdate);
                $difference = $datetime1->diff($datetime2);
                $bedahari = $difference->days;
                if($datetime2>$datetime1){
                  $bedahari = -1 * $bedahari;
                }
              @endphp
              @if (($bedahari<=7)&&($bedahari>0))
                <td title="{{$data->jum}} bahan">{{$bedahari}} hari lagi</td>
              @elseif(($bedahari<=0)&&($data->kadaluarsa!=null))
                <td title="{{$data->jum}} bahan">Sudah Kadaluarsa</td>
              @elseif($data->kadaluarsa!=null)
                <td title="{{$data->jum}} bahan">{{$data->kadaluarsa}}</td>
              @else
                <td>Tanggal Belum diatur</td>
              @endif
              <td><button onclick="edit_ing({{$data->no}})" class="whiteedit prosesbtn green" type="button">Edit</button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <input type="hidden" id="tempchange">
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
