function simpan_data(){
  var nama = document.getElementById("nama").value;
  var kelamin = document.getElementById("temp").value;
  var alamat = document.getElementById("alamat").value;
  var telepon = document.getElementById("telepon").value;
  if((nama!="")||(kelamin!="")){
    document.getElementById("simpan").type="submit";
    document.getElementById("simpan").submit();
  }else{
    swal({
      title: "Error",
      text: "Masih terdapat kolom berlabel * yang belum diisi",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function batalkanproses(){
  var url = window.location.href;
  window.location.href = url;
}

function checktemp(val){
  document.getElementById("temp").value = val;
}

function ubahsandi(){
  var lama = document.getElementById("sandilama").value;
  var baru = document.getElementById("sandibaru").value;
  var konf = document.getElementById("konfbaru").value;
  if((lama=="")||(baru=="")||(konf=="")){
    swal({
      title: "Error",
      text: "Kolom password lama, password baru atau konfirmasi password belum diisi",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }else if(konf!=baru){
    swal({
      title: "Error",
      text: "Password baru dan konfirmasi password tidak sama",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }else{
    document.getElementById("ubah").type="submit";
    document.getElementById("ubah").submit();
  }
}
