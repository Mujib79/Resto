function validasi_logout(){
  var nip = $("#nip").val();
  var pass = $("#password").val();
  if((nip!="")&&(pass!="")){
    var form = $('#seriallogout')[0]; // You need to use standard javascript object here
    var frdata = new FormData(form);
    generate_token();
    $.ajax({
      type: "POST",
      url: "pelanggan/logout",
      data: frdata,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend  : function(){
          $("#load").show();
        },
      success: function(data){
        $("#load").hide();
        location.reload(false);
      }
    });
  }else{
    swal({
      title:"Pemberitahuan",
      text: "Kolom NIP atau password masih kosong",
      type: "info",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function simpan_feedback(){
  var obj = document.getElementById("perihal");
  if(obj.value!=""){
    var form = $('#formfeedback')[0]; // You need to use standard javascript object here
    var frdata = new FormData(form);
    generate_token();
    $.ajax({
      type: "POST",
      url: "pelanggan/simpan-feedback",
      data: frdata,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend  : function(){
          $("#load").show();
        },
      success: function(data){
        $("#load").hide();
        $("#perihal").val("");
        $("#feedback").val("");
        popup("feedback",0);
      }
    });
  }else{
    swal({
      title:"Pemberitahuan",
      text: "Kolom Judul/Perihal masih kosong",
      type: "info",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function bayar(){
  var rows = $("#order-table tbody tr").length;
  if(rows!=0){
    if($("#tempjum").val()==$("#temppesan").val()){
      // clearInterval(loadinterval);
      $("#temploop").val(0);
      generate_token();
      ajax_operation("post","pelanggan/bayar","#bodycontent");
      popup('feedback',1);
    }else{
      swal({
        title:"Pemberitahuan",
        text: "Anda masih dalam proses pemesanan, lakukan pembayaran hanya jika ingin mengakhiri pembelian hidangan",
        type: "info",
        confirmButtonColor: "#2b5dcd",
        confirmButtonText: "OK",
        closeOnConfirm: true
      });
    }
  }else{
    swal({
      title:"Pemberitahuan",
      text: "Anda belum memesan apapun",
      type: "info",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function order(){
  var tbl = document.getElementById("order-table");
  if(tbl.rows.length != 1){
    generate_token();
    ajax_operation("post","pelanggan/order-pesanan","#bodycontent");
  }else{
    swal({
      title:"Pemberitahuan",
      text: "Daftar pesanan anda masih kosong",
      type: "info",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function hitung_total(notrans,val){
  $("#total"+notrans).html("Rp. "+($("#harga"+notrans).attr("data-value")*val).formatMoney(0,',','.'));
}

function simpan_jumlah(notrans,obj){
  if(obj.value!=""){
    hitung_total(notrans,obj.value);
    generate_token();
    ajax_operation("post","pelanggan/simpan-jumlah/"+notrans+"/"+obj.value,"");
  }
}

function get_catatan(notrans){
  ajax_operation("get","pelanggan/get-catatan/"+notrans,"#kolomisian");
}

function simpan_catatan(notrans){
    var form = $('#formcatatan')[0]; // You need to use standard javascript object here
    var frdata = new FormData(form);
    generate_token();
    $.ajax({
      type: "POST",
      url: "pelanggan/simpan-catatan/"+notrans,
      data: frdata,
      cache: false,
      processData: false,
      contentType: false,
      beforeSend  : function(){
          $("#load").show();
        },
      success: function(data){
        $("#load").hide();
      }
    });
}

function search_dish(obj,sts){
  if(sts==0){
    var $panel = $('.dishpanel');
    var val = $.trim($(obj).val()).replace(/ +/g, ' ').toLowerCase();

    $panel.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
    $(".kelompok_tipe").eq(0).show();
    $(".kelompok_tipe").eq(1).show();
    $(".kelompok_tipe").eq(2).show();
    $(".kelompok_tipe").eq(3).show();
    if ($(".kelompok_tipe").eq(0).children(".dishpanel:visible").length==0) {
      $(".kelompok_tipe").eq(0).hide();
    }

    if ($(".kelompok_tipe").eq(1).children(".dishpanel:visible").length==0){
      $(".kelompok_tipe").eq(1).hide();
    }

    if ($(".kelompok_tipe").eq(2).children(".dishpanel:visible").length==0) {
      $(".kelompok_tipe").eq(2).hide();
    }

    if ($(".kelompok_tipe").eq(3).children(".dishpanel:visible").length==0){
      $(".kelompok_tipe").eq(3).hide();
    }
  }else {
    var $panel = $('#order-table tbody tr');
    var val = $.trim($(obj).val()).replace(/ +/g, ' ').toLowerCase();

    $panel.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
  }
}

function change_state(id){
  var temp = document.getElementById("tempfirstid").value;
  if(id!=temp){
    $(temp).toggleClass("active");
    $("#dashboardbody").toggleClass("hidden");
    $("#pesanan").toggleClass("hidden");
    $("#shsearch input").toggleClass("hidden");
    document.getElementById("tempfirstid").value = id;
    $(id).toggleClass("active");
  }
}

function justnumber(obj){
  obj.value = obj.value.replace(/[^0-9]/g,'');
  if(obj.value==""){
    obj.value=1;
    obj.setAttribute("data-value",1);
  }
  return true;
}

function set_order(no){
  if($("#temploop").val()==0){
    $("#temploop").val(1);
    // load_keranjang();
    // var loadinterval = setInterval("load_keranjang()",3000);
  }
  generate_token();
  ajax_operation("post","pelanggan/set-order/"+no,"#bodycontent");
}

function hapus_transaksi(notrans){
  var rows = document.getElementById("bodycontent").rows.length;
  if(rows==1){
    $("#temploop").val(0);
    // $("#notification").html("0");
    $("#notification").css("display","none");
  }
  generate_token();
  ajax_operation("post","pelanggan/hapus_transaksi/"+notrans+"/"+rows,"#bodycontent");
}

function load_keranjang(){
  $.ajax({
    type: "get",
    url: "pelanggan/load-keranjang",
    cache: false,
    processData: false,
    contentType: false,
    success: function(data){
      $("#bodycontent").html(data);
    }
  });
}
