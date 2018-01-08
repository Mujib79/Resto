function tampilkan_pesan(tbl,row){
  popup("popcatatan",1);
  var val = document.getElementById(tbl).rows[row].cells[5].innerHTML;
  val = val.replace(/(?:\r\n|\r|\n)/g, '<br />');
  $("#tampil-catatan").html(val);
}

function cek_pesanan(){
  $("#wrap-table").load("koki/show_order");
}

function change_color(id,sts){
  if(sts==1){
    var temp = document.getElementById("tempid").value;
    if((id!=temp)&&(temp!="#")){
      $(temp).toggleClass("active-child");
      document.getElementById("tempid").value = id;
      $(id).toggleClass("active-child");
    }else if(id!=temp){
      document.getElementById("tempid").value = id;
      $(id).toggleClass("active-child");
    }
  }else{
    var temp = document.getElementById("tempfirstid").value;
    if(id!=temp){
      if(temp=='#f3'){
        var tempchild = document.getElementById("tempid").value;
        $(tempchild).toggleClass("active-child");
        document.getElementById("tempid").value="#";
      }
      $(temp).toggleClass("active");
      document.getElementById("tempfirstid").value = id;
      $(id).toggleClass("active");
    }
  }
}

function status_buat(nopesan,sts,i,notrans){
  if(sts==2){
    generate_token();
    ajax_operation("POST","koki/status_buat/"+sts+"/"+nopesan+"/"+notrans,"");
    document.getElementById("btn"+i).innerHTML="Selesai";
    $("#btn"+i).attr("onclick","status_buat("+nopesan+",3,"+i+","+notrans+")");
  }else{
    generate_token();
    ajax_operation("POST","koki/status_buat/"+sts+"/"+nopesan+"/"+notrans,"#wrap-detail");
  }
}

function show_detail(no){
  ajax_operation("GET","koki/show-detail-order/"+no,"#wrap-detail");
}

function add_new(sts){
  if(sts==0){
    $("#t_databahan").remove();
    ajax_operation("GET","koki/data-baru","#content");
    popup('editbahanbaku',0);
  }else{
    var nama = document.getElementById('addnamabahan').value;
    document.getElementById('addnamabahan').value = "";
    if(nama!=""){
      var temp = document.getElementById("tempid").value.substr(1);
      if(temp == ""){
        $("#tempid").val("shing");
        temp = "shing";
      }
      popup('addbahanbaku',1);
      generate_token();
      ajax_operation("post","koki/new-ingredient/"+nama+"/"+temp,"#content");
    }else{
      swal({
        title: "Error",
        text: "Nama bahan tidak boleh kosong",
        type: "error",
        confirmButtonColor: "#2b5dcd",
        confirmButtonText: "OK",
        closeOnConfirm: true
      });
    }
  }
}

function autoheight() {
  var textarea = document.getElementById("judul");
  var heightLimit = 200; /* Maximum height: 200px */
  textarea.style.height = ""; /* Reset the height*/
  textarea.style.height = Math.min(textarea.scrollHeight,heightLimit) + "px";
  if(textarea.scrollHeight > heightLimit){
    $("#judul").css("overflow-y","auto");
  }
}

function validate_form(){
  var judul = $("#judul").val();
  var jenis = $("#jenis").val();
  var harga = $("#harga").val();
  if((judul=="")||(jenis=="")||(harga=="")){
    return false;
  }else{
    return true;
  }
}

function pilih_bahan(){
  popup('databahanbaku',1);
  var tbl = document.getElementById("t_databahan");
  if(tbl==null){
    ajax_operation("GET","koki/get_bahan_baku","#tampil-data");
  }
}

function addrow(no,nama){
  $('#btn'+no).toggleClass("green");
  $('#btn'+no).toggleClass("red");
  if($('#btn'+no).html()=="Pilih"){
    $('#btn'+no).html('Hapus');
    addNewRow(no,nama);
  }else{
    $('#btn'+no).html('Pilih');
    bufferwithbtn(no);
  }
}

function addNewRow(nobahan,nama,jumlah,ket) {
  var tbl = document.getElementById("t_resep");
  var jumrow = tbl.rows.length;
  var row = tbl.insertRow(tbl.rows.length);
  var td = new Array(document.createElement("td"),
                     document.createElement("td"),
                     document.createElement("td"),
                     document.createElement("td"));
  td[0].appendChild(generateNomor(row.rowIndex,nobahan));
  td[1].appendChild(generateNamaBahan(row.rowIndex,nama));
  td[2].appendChild(generateJumlah(row.rowIndex,jumlah));
  td[3].appendChild(generateKet(row.rowIndex,ket));
  row.appendChild(td[0]);
  row.appendChild(td[1]);
  row.appendChild(td[2]);
  row.appendChild(td[3]);
}

function generateNomor(index,nobahan) {
  var idx   = document.createElement("input");
  idx.type  = "hidden";
  idx.name  = "no"+index;
  idx.id    = "no"+index;
  idx.value = nobahan;
  return idx;
}

function generateNamaBahan(index,val) {
  var idx  = document.createElement("input");
  idx.type = "text";
  idx.name = "namabahan"+index;
  idx.id   = "namabahan"+index;
  idx.placeholder = "Nama Bahan";
  if(val!=null){
    idx.value = val;
  }else{
    idx.value = "";
  }
  idx.readOnly = "readOnly";
  return idx;
}

function generateJumlah(index,val) {
  var idx  = document.createElement("input");
  idx.type = "number";
  idx.min = 0;
  idx.name = "jum"+index;
  idx.id   = "jum"+index;
  idx.placeholder = "Jumlah";
  idx.onkeyup = function (event){
    if(event.keyCode!=190){
      if((event.keyCode > 57)||((event.keyCode<48)&&(event.keyCode>32))){
        this.value = this.value.replace(/[^0-9]/g,'');
        return true;
      }
    }
  };
  if(val!=null){
    idx.value = val;
  }else{
    idx.value = "";
  }
  return idx;
}

function generateKet(index,val) {
  var idx  = document.createElement("input");
  idx.type = "text";
  idx.name = "ket"+index;
  idx.id   = "ket"+index;
  idx.placeholder = "Keterangan";
  if(val!=null){
    idx.value = val;
  }else{
    idx.value = "";
  }
  return idx;
}

function deleteAll() {
  var tbl = document.getElementById("t_resep");
  var rowLen = tbl.rows.length;
  for (var idx=rowLen;idx > 0;idx--) {
    tbl.deleteRow(idx-1);
  }
}

function bufferwithbtn(no){
  var table = document.createElement('table');
  var tbl = document.getElementById('t_resep');
  var rowlen = tbl.rows.length;
  for (var idx=0;idx<rowlen;idx++) {;
    var row = tbl.rows[idx];
    if(row.cells[0].lastChild.value != no){
      var rowNew = table.insertRow(table.rows.length);
      var td = new Array(document.createElement("td"),
      document.createElement("td"),
      document.createElement("td"),
      document.createElement("td"));
      td[0].appendChild(row.cells[0].lastChild);
      td[1].appendChild(row.cells[1].lastChild);
      td[2].appendChild(row.cells[2].lastChild);
      td[3].appendChild(row.cells[3].lastChild);
      rowNew.appendChild(td[0]);
      rowNew.appendChild(td[1]);
      rowNew.appendChild(td[2]);
      rowNew.appendChild(td[3]);
    }
  }
  deleteAll();
  reIndex(table);
}

function reIndex(table) {
  var tbl = document.getElementById("t_resep");
  var rowLen = table.rows.length;
  for (var idx=0;idx < rowLen;idx++) {
    var row = table.rows[idx];
    var rowTbl = tbl.insertRow(tbl.rows.length);
    var td = new Array(document.createElement("td"),
              document.createElement("td"),
              document.createElement("td"),
              document.createElement("td"));
    td[0].appendChild(generateNomor(row.rowIndex,row.cells[0].lastChild.value));
    td[1].appendChild(generateNamaBahan(row.rowIndex,row.cells[1].lastChild.value));
    td[2].appendChild(generateJumlah(row.rowIndex,row.cells[2].lastChild.value));
    td[3].appendChild(generateKet(row.rowIndex,row.cells[3].lastChild.value));
    rowTbl.appendChild(td[0]);
    rowTbl.appendChild(td[1]);
    rowTbl.appendChild(td[2]);
    rowTbl.appendChild(td[3]);
  }
}

function kembali(){
  var id = $('#tempid').val().substr(1);
  $("#t_databahan").remove();
  generate_token();
  ajax_operation('GET','koki/show/'+id,"#content");
}

function generate_info(){
  var nama = document.getElementById("judul").value;
  var info = document.getElementById("info");
  if(nama.length>30){
    info.innerHTML = "<b><span  style='color:yellow'> Tambahkan Gambar: </span>"+nama.substr(0,27)+"...</b>";
  }else{
    info.innerHTML = "<b><span  style='color:yellow'> Tambahkan Gambar: </span>"+nama+"</b>";
  }
}

function browse(){
    document.getElementById("mask-browse").click();
}

function delete_image(){
  var hapus = document.getElementById('delete-image');
  var unggah = document.getElementById('unggah');
  swal({
    title: "Hapus foto ini ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#952828",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  },
  function(isConfirm){
    if(isConfirm){
      hapus.disabled = true;
      unggah.disabled = false;
      document.getElementById("tempimg").value = "";
      document.getElementById("path").value = "";
      document.getElementById("img").src = "public/gambar/notfound.png";
    }
  });
}

function PreviewImage() {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById('mask-browse').files[0]);
  oFReader.onload = function (oFREvent) {
    document.getElementById('imgcrop').src = oFREvent.target.result;
    var image = $('#imgcrop').croppie({
        enableExif: true,
        viewport: {
            width: 94,
            height: 94,
            type: 'rectangle'
        },
        boundary: {
            width: 100,
            height: 100
        }
    });
    $('#Tetapkan').on('click', function (ev){
     image.croppie('result',{
       type: 'canvas',
       size: 'original'
     }).then(function (resp){
       document.getElementById('unggah').disabled = true;
       document.getElementById('delete-image').disabled = false;
       $('#img').attr('src',resp);
       $('#tempimg').val(resp);
       close_popup();
     });
   });
  };
};

function popup_edit_ing(no,nama){
  popup("editbahanbaku",1);
  document.getElementById("namabahan").value = nama;
  document.getElementById("tempnobahan").value = no;
}

function edit_data(id,sts){
  if(sts==0){
    $("#t_databahan").remove();
    ajax_operation('GET','koki/edit/'+id,"#content");
  }else{
    var nama = document.getElementById("namabahan").value;
    document.getElementById("namabahan").value = "";
    document.getElementById("tempnobahan").value = "";
    if(nama!=""){
      generate_token();
      ajax_operation('POST','koki/update-ingredient/'+id+"/"+nama,"#content");
      popup("editbahanbaku",0);
    }else{
      swal({
        title: "Error",
        text: "Nama bahan tidak boleh kosong",
        type: "error",
        confirmButtonColor: "#2b5dcd",
        confirmButtonText: "OK",
        closeOnConfirm: true
      });
    }
  }
}

function permanen_delete(id,nama,sts){
  swal({
    title: "Data "+nama+" akan dihapus permanen ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#952828",
    cancelButtonText: "Tidak",
    confirmButtonText: "Ya",
    closeOnConfirm: true
  },
  function(isConfirm){
    if(isConfirm){
      generate_token();
      if(sts==0){
        ajax_operation("POST","koki/delete-permanently/"+id,"#content");
      }else{
        ajax_operation("POST","koki/delete-permanently-ingredient/"+id,"#content");
      }
    }
  });
}

function delete_data(id,nama,sts){
  swal({
    title: "Hapus data "+nama+" ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#952828",
    cancelButtonText: "Tidak",
    confirmButtonText: "Ya",
    closeOnConfirm: true
  },
  function(isConfirm){
    if(isConfirm){
      kode = document.getElementById("tempid").value.substr(1);
      generate_token();

      if(sts==0){
        ajax_operation("POST","koki/delete/"+id+"/"+kode,"#content");
      }else{
        ajax_operation("POST","koki/delete_ingredient/"+id+"/"+kode,"#content");
      }
    }
  });
}

function update_food(id){
  if(validate_form()){
    generate_token();
    var form = $('#serialdata')[0]; // You need to use standard javascript object here
    var frdata = new FormData(form);
    $.ajax({
      type: "POST",
      url: "koki/update/"+id,
      data: frdata,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend  : function(){
          $("#load").show();
        },
      success: function(data){
        $("#load").hide();
        $("#img").attr('src',"");
        $("#content").html(data);
      }
    });
  }else{
    swal({
      title: "Error",
      text: "Terdapat kolom kosong pada form dengan prioritas (*)",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function add_food(){
  if(validate_form()){
    generate_token();
    var form = $('#serialdata')[0]; // You need to use standard javascript object here
    var frdata = new FormData(form);
    $.ajax({
      type: "POST",
      url: "koki/add_food",
      data: frdata,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend  : function(){
          $("#load").show();
        },
      success: function(data){
        $("#load").hide();
        $("#img").attr('src',"");
        $("#content").html(data);
      }
    });
  }else{
    swal({
      title: "Error",
      text: "Terdapat kolom kosong pada form dengan prioritas (*)",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function sort_data(id){
  ajax_operation("GET","koki/show/"+id,"#content");
}

function restore(id,sts){
  generate_token();
  if(sts==0){
    ajax_operation("POST","koki/restore/"+id,"#content");
  }else{
    ajax_operation("POST","koki/restore-ingredient/"+id,"#content");
  }
}
