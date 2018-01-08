function get_data_pelanggan(){
  ajax_operation("get","kasir/get-daftar-bayar","#bodytbl");
}

function change_label(id){
  $("#"+id).attr("style","font-size:20px");
}

function detail_pesan(no,nomeja,row){
  change_label('lbl1');
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();
  if(dd<10) {
      dd='0'+dd
  }
  if(mm<10) {
      mm='0'+mm
  }
  today = mm+'/'+dd+'/'+yyyy;
  $("#simpan").attr("onclick","save_pembayaran("+no+")");
  $("#nomeja").html(" Meja Nomor "+nomeja);
  $("#batal").removeAttr("disabled");
  $("#uang_bayar").attr("onfocus","change_label('lbl2')");
  $("#uang_bayar").removeAttr("readonly");
  $("#total_belanja").val(row.cells[1].innerHTML);
  $("#total_belanja").attr("data-value",row.cells[1].getAttribute("data-value"));
  ajax_operation("get","kasir/get-detail-pesan/"+no,"#tabeldata");
}

function unchange_label(id,obj){
  if(obj.value==""){
    $("#"+id).attr("style","font-size:300%");
  }
}

function hitung_kembali(val){
  if(val!=""){
    $("#uang_kembalian").attr("data-value",parseInt(val)-parseInt($("#total_belanja").attr("data-value")));
    $("#uang_kembalian").val("Rp. "+(parseInt(val)-parseInt($("#total_belanja").attr("data-value"))).formatMoney(0,',','.'));
    change_label('lbl3');
    if($("#uang_kembalian").attr("data-value")>=0){
      $("#simpan").removeAttr("disabled");
    }else{
      $("#simpan").attr("disabled","disabled");
    }
  }else{
    $("#simpan").attr("disabled","disabled");
    $("#uang_kembalian").val("");
    $("#uang_kembalian").attr("data-value",0);
    unchange_label('lbl3',document.getElementById('uang_kembalian'));
  }
}

function clear_data(){
  $("#uang_kembalian").val("");
  $("#total_belanja").val("");
  $("#simpan").removeAttr("onclick");
  $("#uang_bayar").val("");
  $("#uang_bayar").removeAttr("onfocus");
  $("#uang_bayar").attr("readonly","readonly");
  $("#nopesan").html("");
  $("#nomeja").html("");
  $("#tanggal").html("");
  $("#batal").attr("disabled","disabled");
  $("#simpan").attr("disabled","disabled");
  $("#tabeldata").children("tr").remove();
  unchange_label('lbl1',document.getElementById('total_belanja'));
  unchange_label('lbl2',document.getElementById('uang_bayar'));
  unchange_label('lbl3',document.getElementById('uang_kembalian'));
}

function save_pembayaran(nopesan){
  generate_token();
  $.ajax({
    type: "POST",
    url: "kasir/simpan-transaksi/"+nopesan,
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
