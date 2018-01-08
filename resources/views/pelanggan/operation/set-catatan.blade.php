@if (count($datas)>0)
  @foreach ($datas as $data)
  @endforeach
  <form id="formcatatan" method="post">
    <textarea name="catatan">{{$data->catatan}}</textarea>
  </form>
  <button style="margin-top: 5px;margin-bottom:5px;" onclick="simpan_catatan({{$data->no_transaksi}})" class="green prosesbtn save animasi" type="button">Simpan</button>
@endif
