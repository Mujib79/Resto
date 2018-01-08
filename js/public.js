function showslidesidebar(){
  $("#leftsb_menu").toggleClass("showsidebar");
  $("#slidesidebar").toggleClass("leftslide");
  $("#slidesidebar div").toggleClass("rotatearrow");
}

Number.prototype.formatMoney = function(c, d, t){
var n = this,
    c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

function set_interface(id,id1,id2,id3){
  if(($(id1).attr("class")!="max")&&(id1!='')){
    if($(id3).attr("class")!="max"){
      tampil_child('#first-child1','');
    }
    tampil_child(id1,id2);
  }
  change_color(id,0);
}

function tampil_child(id,child){
  $(child).toggleClass("plus");
  $(child).toggleClass("minus");
  $(id).toggleClass("max");
}

function conf_visibility(formname,sts,visibility,int){
  var jum = $("#"+formname+" > input").length;
  if(jum!=0){
    generate_token();
    var form = $('#'+formname)[0]; // You need to use standard javascript object here
    var frdata = new FormData(form);
    $.ajax({
      type: "POST",
      url: int+"/update-ketersediaan/"+sts+"/"+visibility,
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
      text: "Tidak ada data hidangan dicentang",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function generate_input_temp(checkname){
  var parent = document.getElementById("temporarycheck");
  var idx = parent.childElementCount;
  child = document.createElement("input");
  child.type="text";
  child.readOnly = "readonly";
  child.className = "checktemp";
  child.id = "cek"+checkname.substr(5);
  child.name = "cek"+(idx+1);
  child.value = document.getElementById(checkname).value;
  parent.appendChild(child);
}

function delete_input_temp(checkname){
  var parent = document.getElementById("temporarycheck");
  child = document.getElementById("cek"+checkname.substr(5));
  parent.removeChild(child);
  var jum = parent.childElementCount;
  for(i=1;i<=jum;i++){
    parent.getElementsByTagName('input')[(i-1)].name="cek"+i;
  }
}

function checkAll(table,checkname){
  var tabel = document.getElementById(table);
  var rows = tabel.rows.length-1;
  checked = false;
  if(document.getElementById("checkMaster").checked){
    checked = true;
  }
  var parent = document.getElementById("temporarycheck");
  if(checked){
    if(parent.childElementCount!=0){
      $("#temporarycheck").empty();
    }
    j=0;
    for(i=0;i<rows;i++){
      if($("#"+table+" tbody tr:nth-child("+(i+1)+")").css('display') != "none"){
        document.getElementById(checkname+i).checked = checked;
        child = document.createElement("input");
        child.type="text";
        child.readOnly = "readonly";
        child.id = "cek"+i;
        child.name = "cek"+(j+1);
        child.className = "checktemp";
        child.value = document.getElementById(checkname+i).value;
        parent.appendChild(child);
        j++;
      }
    }
  }else{
    for(i=0;i<rows;i++){
      document.getElementById(checkname+i).checked = checked;
      child = document.getElementById("cek"+i);
      parent.removeChild(child);
    }
  }
}

function check_row(checkname,sts){
  var checkbox = document.getElementById(checkname);
  if(checkbox.checked){
    if(sts==0){
      checkbox.checked = false;
      delete_input_temp(checkname);
    }else{
      generate_input_temp(checkname);
    }
  }else{
    if(sts==0){
      checkbox.checked = true;
      generate_input_temp(checkname);
    }else{
      delete_input_temp(checkname);
    }
  }
}

function search_data(obj,table){
  var $rows = $('#'+table+' tbody tr');
  var val = $.trim($(obj).val()).replace(/ +/g, ' ').toLowerCase();

  $rows.show().filter(function() {
      var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
      return !~text.indexOf(val);
  }).hide();
}

function disp(id){
  $(id).toggleClass("hide");
}

function just_number(obj){
  obj.value = obj.value.replace(/[^0-9]/g,'');
  if(obj.value==""){
    obj.value=0;
    obj.setAttribute("data-value",0);
  }
  return true;
}

function validasi(evt,obj){
  if(evt.keyCode!=190){
    if((evt.keyCode > 57)||((evt.keyCode>32)&&(evt.keyCode<48))){
      obj.value = obj.value.replace(/[^0-9]/g,'');
      return true;
    }
  }
}

function popup(wrappop,aksi){
  var popupbox  = document.getElementById('popupBox');
  var wrap      = document.getElementById(wrappop);
  if(aksi==1){
    popupbox.style.display = 'block';
    wrap.style.display = 'block';
  }else{
    popupbox.style.display = 'none';
    wrap.style.display = 'none';
  }
}

function log_out(){
  window.location.href = "/Resto/logout";
}

function ajax_operation(tipe,url,content){
  $.ajax({
    type: tipe,
    url: url,
    beforeSend  : function(){
        $("#load").show();
      },
    success: function(data){
      $("#load").hide();
      if(content!=""){
        $(content).html(data);
      }
    }
  });
}

function generate_token(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
       close_popup();
       document.getElementById('unggah').disabled = true;
       document.getElementById('delete-image').disabled = false;
       $('#img').attr('src',resp);
       $('#tempimg').val(resp);
     });
   });
  };
};

function ValidateSingleInput(oInput) {
  var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];
  if (oInput.type == "file") {
      var sFileName = oInput.value;
       if (sFileName.length > 0) {
          var blnValid = false;
          for (var j = 0; j < _validFileExtensions.length; j++) {
              var sCurExtension = _validFileExtensions[j];
              if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                  blnValid = true;
                  break;
              }
          }
          if (!blnValid) {
              swal({
                title: "Error",
                text: "Maaf,"+sFileName+" ekstensi file ini tidak cocok,\nberikut ekstensi yang diizinkan "+_validFileExtensions.join(", "),
                type: "error",
                confirmButtonColor: "#2b5dcd",
                confirmButtonText: "OK",
                closeOnConfirm: true
              });
              oInput.value = "";
              return false;
          }else{
            document.getElementById("path").value = document.getElementById("mask-browse").value;
            if(document.getElementById("path").value.length>30){
              document.getElementById("path").value = document.getElementById("path").value.substr(0,27)+"...";
            }
            popup('cropping',1);
            PreviewImage();
          }
      }
  }
  return true;
}

function close_popup(){
  popup('cropping',0);
  var img_edit = document.getElementsByClassName("wrappop")[0];
  img_edit.removeChild(document.getElementsByClassName("croppie-container")[0]);
  var img = document.createElement("img");
  $("#path").val("");
  img.id = "imgcrop";
  img_edit.appendChild(img);
}
