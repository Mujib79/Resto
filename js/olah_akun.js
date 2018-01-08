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
      document.getElementById("path").value = "";
      document.getElementById("img").src = "public/gambar/notfound.png";
      document.getElementById("tempimg").value = "";
    }
  });
}

function simpan_perubahan(){
  var nama = $("#nama").val();
  if(document.getElementById("P").checked){
    var kelamin = "P";
  }else{
    var kelamin = "W";
  }
  if((nama=="")||(kelamin == "")){
    swal({
      title: "Error",
      text: "Kolom dengan tanda (*) tidak boleh kosong",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }else{
    generate_token();
    var form = $('#serialize')[0]; // You need to use standard javascript object here
    var frdata = new FormData(form);
    generate_token();
    $.ajax({
      type: "POST",
      url: "olah-akun/update-data-pegawai",
      data: frdata,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend  : function(){
          $("#load").show();
        },
      success: function(data){
        $("#load").hide();
        location.reload(true);
      }
    });
  }
}

function clear_form(){
  $("#plama").val("");
  $("#pbaru").val("");
  $("#pkonfirmasi").val("");
}

function show_data(id){
  ajax_operation("GET","olah-akun/show/"+id,"#content");
}

function change_color(id,sts){
  var temp = document.getElementById("tempfirstid").value;
  if(id!=temp){
    $(temp).toggleClass("active");
    document.getElementById("tempfirstid").value = id;
    $(id).toggleClass("active");
  }
}

function ganti_password(){
  var plama = $("#plama").val();
  var pbaru = $("#pbaru").val();
  var pkonfirmasi = $("#pkonfirmasi").val();
  if((plama!="")&&(pbaru!="")&&(pkonfirmasi!="")){
    if(pbaru==pkonfirmasi){
      var form = $('#serialize')[0]; // You need to use standard javascript object here
      var frdata = new FormData(form);
      generate_token();
      $.ajax({
        type: "POST",
        url: "olah-akun/ganti-password",
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
        text: "Password baru dengan konfirmasinya tidak cocok",
        type: "error",
        confirmButtonColor: "#2b5dcd",
        confirmButtonText: "OK",
        closeOnConfirm: true
      });
    }
  }else{
    swal({
      title: "Error",
      text: "Masih terdapat kolom isian yang kosong",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}
