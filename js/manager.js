function delete_row_feedback(formname){
  var jum = $("#"+formname+" input").length;
  if(jum!=0){
    generate_token();
    var form = $('#'+formname)[0]; // You need to use standard javascript object here
    var frdata = new FormData(form);
    $.ajax({
      type: "POST",
      url: "manager/delete-row-feedback",
      data: frdata,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend  : function(){
          $("#load").show();
        },
      success: function(data){
        $("#load").hide();
        $("#content").html(data);
      }
    });
  }else{
    swal({
      title: "Error",
      text: "Tidak ada data feedback  dicentang",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function ceklis_tanda(i){
  document.getElementById("check"+i).click();
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
  $("#temporarycheck").empty();
  for(var i=1;i<=(tbl.rows.length-1);i++){
    document.getElementById("check"+i).checked = cek;
  }
  if(cek){
    for(var i=1;i<=(tbl.rows.length-1);i++){
      temp_data(i,document.getElementById("check"+i),1);
    }
  }
}

function temp_data(urutan,obj){
  var jumchild = $("#temporarycheck input").length;
  var parent = document.getElementById("temporarycheck");
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
  if($("#temporarycheck input").length>0){
    $("#hps").removeAttr("disabled");
  }else{
    $("#hps").attr("disabled","disabled");
  }
}

function detail_data(noreport){
  ajax_operation("get","manager/detail-report/"+noreport,"#content");
}

function paging(limit,id,sts){
  if($("#temppaging").val()!=id){
    $(id).toggleClass("activepaging");
    $($("#temppaging").val()).toggleClass("activepaging");
    $("#temppaging").val(id);
    if(sts==1){
      ajax_operation("get","manager/paging/"+limit,"#bodycontent");
    }else{
      ajax_operation("get","manager/paging-feedback/"+limit,"#bodycontent");
    }
  }
}

function backup_pengeluaran(noreport){
  ajax_operation("get","manager/backup-pengeluaran/"+noreport,"");
}

function backup(sts){
  if($("#temptahunan").val()!=""){
    var tahun = $("#temptahunan").val();
    if($("#tempbulanan")[0]!=null){
      if($("#tempbulanan").val()!=""){
        var bulan = $("#tempbulanan").val();
        ajax_operation("get","manager/backup/"+sts+"/"+tahun+"/"+bulan,"");
      }else{
        swal({
          title: "Error",
          text: "Data tidak ditemukan",
          type: "error",
          confirmButtonColor: "#2b5dcd",
          confirmButtonText: "OK",
          closeOnConfirm: true
        });
      }
    }else{
      ajax_operation("get","manager/backup/"+sts+"/"+tahun+"/def","");
    }
  }else{
    swal({
      title: "Error",
      text: "Data tidak ditemukan",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function restore_laporan(noreport){
  generate_token();
  if($("#data-table tbody tr").length!=1){
    ajax_operation("post","manager/restore-report/"+noreport,"#bodycontent");
  }else{
    ajax_operation("post","manager/restore-report/"+noreport,"#content");
  }
}

function delete_data(noreport,sts){
  if(sts==1){
    swal({
      title: "Hapus laporan belanja nomor "+noreport+"?",
      text: "Data akan dipindahkan ke sampah",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#952828",
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    },
    function(isConfirm){
      if(isConfirm){
        generate_token();
        if($("#data-table tbody tr").length!=1){
          ajax_operation("post","manager/delete-report/"+noreport,"#bodycontent");
        }else{
          ajax_operation("post","manager/delete-report/"+noreport,"#content");
        }
      }
    });
  }else{
    swal({
      title: "Hapus laporan belanja nomor "+noreport+"?",
      text: "Data akan dihapus permanen",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#952828",
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    },
    function(isConfirm){
      if(isConfirm){
        generate_token();
        if($("#data-table tbody tr").length!=1){
          ajax_operation("post","manager/delete-report-permanent/"+noreport,"#bodycontent");
        }else{
          ajax_operation("post","manager/delete-report-permanent/"+noreport,"#content");
        }
      }
    });
  }
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

function sort_proses(){
  var year = $("#tahun").val();
  if(year!=""){
    if($("#bulan")[0]!=null){
      var month = $("#bulan").val();
      if(month!=""){
        ajax_operation("get","manager/sort-by/"+month+"/"+year,"#bodycontent");
      }else{
        swal({
          title: "Error",
          text: "Anda belum memilih urutan bulan",
          type: "error",
          confirmButtonColor: "#2b5dcd",
          confirmButtonText: "OK",
          closeOnConfirm: true
        });
      }
    }else{
      ajax_operation("get","manager/sort-by/def/"+year,"#bodycontent");
    }
  }else{
    swal({
      title: "Error",
      text: "Anda belum memilih urutan tahun",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function sort_data(id){
  if(id!=""){
    ajax_operation("get","manager/show/"+id,"#content");
  }
}

function hapuspegawai(nip,nama){
  swal({
    title: "Hapus data pegawai dengan nama "+nama+"?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#952828",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  },
  function(isConfirm){
    if(isConfirm){
      generate_token();
      if($("#data-table tbody tr").length!=1){
        ajax_operation("post","manager/delete-employee/"+nip,"#bodycontent");
      }else{
        ajax_operation("post","manager/delete-employee/"+nip,"#content");
      }
    }
  });
}

function simpanpegawai(sts){
  if($("#data-table")[0]!=null){
    var rows = $("#data-table tr").length;
  }else{
    var rows = 0;
  }
  if(sts==1){
    var nama = $("#nama").val();
    var alamat = "manager/add-employee/"+rows;
    var jabatan = $("#jabatan").val();
    var form = $('#serialdata')[0]; // You need to use standard javascript object here
    if(document.getElementById("P").checked){
      var kelamin = "P";
    }else if(document.getElementById("W").checked){
      var kelamin = "W";
    }else{
      var kelamin = "";
    }
  }else{
    var nama = $("#namapegawai").val();
    var alamat = "manager/update-employee/"+document.getElementById("tempnip").value;
    var jabatan = $("#jabat").val();
    var form = $('#serialdataedit')[0]; // You need to use standard javascript object here
    if(document.getElementById("Pria").checked){
      var kelamin = "P";
    }else if(document.getElementById("Wanita").checked){
      var kelamin = "W";
    }else{
      var kelamin = "";
    }
  }
  if((nama!="")&&(jabatan!="")&&(kelamin!="")){
    generate_token();
    var frdata = new FormData(form);
    $.ajax({
      type: "POST",
      url: alamat,
      data: frdata,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend  : function(){
          $("#load").show();
        },
      success: function(data){
        $("#load").hide();
        if(rows>0){
          $("#bodycontent").html(data);
        }else{
          $("#content").html(data);
        }
        batalsimpan();
        set_interface('#f2','','','');
      }
    });
  }else{
    swal({
      title: "Error",
      text: "Kolom nama, jabatan atau jenis kelamin masih kosong",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function editpegawai(nip){
  ajax_operation("get","manager/edit-pegawai/"+nip,"#content");
}

function batalsimpan(){
  $("#nama").val("");
  $("#jabatan").val("");
  document.getElementById("P").checked = false;
  document.getElementById("W").checked = false;
}
