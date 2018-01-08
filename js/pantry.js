function kirim(no){
  swal({
    title: "Konfirmasi",
    text: "Laporan yang dikirim ke manager tidak akan ditampilkan kembali, ingin lanjut?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#952828",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  },
  function(isConfirm){
    if(isConfirm){
      // alert($("#bodycontent tr").length);
      generate_token();
      if($("#bodycontent tr").length==1){
        ajax_operation("post","pantry/kirim/"+no+"/0","#content");
      }else{
        ajax_operation("post","pantry/kirim/"+no+"/1","#bodycontent");
      }
    }
  });
}

function ceklis_tanda(i){
  var cek = document.getElementById("check"+i);
  if(cek.checked){
    document.getElementById("check"+i).checked = false;
  }else{
    document.getElementById("check"+i).checked = true;
  }
  temp_data(i,cek,0);
}

function change_color(id,sts){
  if(sts==0){
    var temp = document.getElementById("tempfirstid").value;
    if(id!=temp){
      $(temp).toggleClass("active");
      document.getElementById("tempfirstid").value = id;
      $(id).toggleClass("active");
      temp = document.getElementById("tempid").value;
      if(temp!='#'){
        $("#tempid").val('#');
        $(temp).toggleClass("active");
      }
    }
  }else{
    var temp = document.getElementById("tempid").value;
    if((id!=temp)&&(temp!='#')){
      $(temp).toggleClass("active");
      document.getElementById("tempid").value = id;
      $(id).toggleClass("active");
    }else if(temp=='#'){
      document.getElementById("tempid").value = id;
      $(id).toggleClass("active");
    }
  }
}

function temp_change(obj){
  $("#tempchange").val(obj.value);
}

function change_state(evt,i,id){
  var str = evt.shiftKey+evt.keyCode;
  if(str==9){
    evt.preventDefault();
    $(id+i).focus();
  }else if(str==10){
    evt.preventDefault();
    $(id+(i-1)).focus();
  }
}

function show(id){
  ajax_operation("get","pantry/show/"+id,"#content");
}

function edit_ing(no){
  ajax_operation("get","pantry/edit-ingredient/"+no,"#content");
}

function save_data(id,no,noreg,obj){
  if(noreg==""){
    noreg = 'def';
  }
  generate_token();
  ajax_operation("post","pantry/save-data/"+id+"/"+no+"/"+noreg+"/"+obj.value,"");
}

function add_new_row(no,sts){
  generate_token();
  ajax_operation("post","pantry/add-new-row/"+no+"/"+sts,"#tbodydetail");
}

function delete_row(no,sts){
  if(sts==0){
    var pesan = "Hapus data detail bahan yang dicentang?";
  }else{
    var pesan = "Hapus data detail laporan yang dicentang?";
  }
  swal({
    title: pesan,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#952828",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  },
  function(isConfirm){
    if(isConfirm){
      $("#hps").attr("disabled","disabled");
      generate_token();
      var form = $('#serialdata')[0]; // You need to use standard javascript object here
      var frdata = new FormData(form);
      $.ajax({
        type: "POST",
        url: "pantry/delete-row/"+no+"/"+sts,
        data: frdata,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend  : function(){
          $("#load").show();
        },
        success: function(data){
          $("#load").hide();
          $("#tbodydetail").html(data);
        }
      });
    }
  });
}

function clickAllfood(){
  var tbl = document.getElementById("data-table");
  if($("#checkmaster:checked").length==1){
    var cek = true;
    $("#tersedia").removeAttr("disabled");
    $("#tidaktersedia").removeAttr("disabled");
  }else{
    var cek = false;
    $("#tersedia").attr("disabled","disabled");
    $("#tidaktersedia").attr("disabled","disabled");
  }
  for(var i=1;i<tbl.rows.length;i++){
    if($("#data-table tbody tr:nth-child("+i+")").css("display")!="none")
      document.getElementById("check"+i).checked = cek;
  }
  $("#serialdata").empty();
  if(cek){
    for(var i=1;i<tbl.rows.length;i++){
      temp_data(i,document.getElementById("check"+i),0);
    }
  }
}

function clickAll(tableid){
  var tbl = document.getElementById(tableid);
  if($("#checkmaster:checked").length==1){
    var cek = true;
    $("#hps").removeAttr("disabled");
  }else{
    var cek = false;
    $("#hps").attr("disabled","disabled");
  }
  $("#serialdata").empty();
  if(tableid=="headtbldetail"){
    for(var i=1;i<=(tbl.rows.length-2);i++){
      document.getElementById("check"+i).checked = cek;
    }
    if(cek){
      for(var i=1;i<=(tbl.rows.length-2);i++){
        temp_data(i,document.getElementById("check"+i),1);
      }
    }
  }else{
    for(var i=1;i<=(tbl.rows.length-1);i++){
      document.getElementById("check"+i).checked = cek;
    }
    if(cek){
      for(var i=1;i<=(tbl.rows.length-1);i++){
        temp_data(i,document.getElementById("check"+i),1);
      }
    }
  }
}

function temp_data(urutan,obj,sts){
  var jumchild = $("#serialdata input").length;
  var parent = document.getElementById("serialdata");
  if(obj.checked){
    var inp = document.createElement("input");
    inp.type="hidden";
    inp.value = obj.value;
    inp.id = "tempinp"+urutan;
    inp.name = "tempinp"+(jumchild+1);
    parent.appendChild(inp);
  }else{
    var child = document.getElementById("tempinp"+urutan);
    parent.removeChild(child);
    for(var i=1;i<jumchild;i++){
      child = parent.children[(i-1)];
      child.name = "tempinp"+i;
    }
  }
  if($("#serialdata input").length>0){
    if(sts==1){
      $("#hps").removeAttr("disabled");
    }else{
      $("#tersedia").removeAttr("disabled");
      $("#tidaktersedia").removeAttr("disabled");
    }
  }else{
    if(sts==1){
      $("#hps").attr("disabled","disabled");
    }else{
      $("#tersedia").attr("disabled","disabled");
      $("#tidaktersedia").attr("disabled","disabled");
    }
  }
}

function search_ing(obj){
  if(obj.value!=""){
    $.ajax({
      type: "get",
      url: "pantry/cari-bahan-baku/"+obj.value,
      cache: false,
      processData: false,
      contentType: false,
      success: function(data){
        $("#listsearch").html(data);
      }
    });
  }
}

function set_metode_cari(obj){
  if(obj.value=="0"){
    $("#incari").attr("onkeyup","search_data(this,'data-table')");
    $("#incari").attr("placeholder","Cari Hidangan");
    $("#listsearch").empty();
    $("#btncari").hide();
    $("#refresh").hide();
  }else{
    $("#incari").attr("onkeyup","search_ing(this)");
    $("#incari").attr("placeholder","Cari dengan bahan baku");
    $("#refresh").show();
    $("#btncari").show();
  }
}

function cari_hidangan_db(sts){
  var str = $("#incari").val();
  if(str!=""){
    ajax_operation("get","pantry/cari-hidangan-dengan-bahan/"+str+"/"+sts,"#table-body");
  }
}

function edit_data(id){
  ajax_operation("get","pantry/edit-data/"+id,"#content");
}

function restore_laporan(id){
  swal({
    title: "Kembalikan laporan nomor "+id+"?",
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
      if($("#data-table tbody tr").length >1){
        ajax_operation("POST","pantry/restore-laporan/"+id,"#bodycontent");
      }else{
        ajax_operation("POST","pantry/restore-laporan/"+id,"#content");
      }
    }
  });
}

function delete_data(id,sts){
  var ket = "";
  if(sts==0){
    ket = "permanen ";
  }
  swal({
    title: "Hapus "+ket+"laporan nomor "+id+"?",
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
      if($("#data-table tbody tr").length >1){
        ajax_operation("POST","pantry/delete/"+id+"/"+sts+"/"+$("#data-table tbody tr").length,"#bodycontent");
      }else{
        ajax_operation("POST","pantry/delete/"+id+"/"+sts+"/"+$("#data-table tbody tr").length,"#content");
      }
    }
  });
}

function save_keterangan(obj,nodetail,noreport){
  if(obj.value!=""){
    generate_token();
    ajax_operation("post","pantry/save-information/"+nodetail+"/"+noreport+"/"+obj.value,"");
  }
}

function save_anggaran(id,obj){
  if(obj.value!=""){
    generate_token();
    ajax_operation("post","pantry/save-budget/"+id+"/"+obj.value,"");
  }
}

function hitung_total(obj,no){
  if(obj.value!=""){
    $("#data-table tbody tr:nth-child("+no+") td:nth-child(5)").html("Rp. "+($("#hrgsatuan"+no).val()*$("#qty"+no).val()).formatMoney(0,',','.'));
  }
}

function save_detail(obj,no_detail,no_report,sts){
  if(obj.value!=""){
    var konten = "";
    if(sts==0){
      konten = "#tbodydetail";
    }
    generate_token();
    ajax_operation("post","pantry/save-detail-laporan/"+sts+"/"+no_report+"/"+no_detail+"/"+obj.value,konten);
  }
}

function add_new_report(sts){
  generate_token();
  if(sts==0){
    ajax_operation("post","pantry/add-new-report/"+sts,"#content");
  }else{
    ajax_operation("post","pantry/add-new-report/"+sts,"#bodycontent");
  }
}
