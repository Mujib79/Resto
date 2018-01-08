function login(username,password,btn){
  var user = document.getElementById(username).value;
  var pass = document.getElementById(password).value;
  if((user!="")&&(pass!="")){
    document.getElementById(btn).type = "submit";
    document.getElementById(btn).click();
  }else{
    swal({
      title: "ERROR",
      text: "Username atau password masih kosong",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }
}

function tetapkan_nomeja(){
  var nomeja = document.getElementById("nomor").value;
  if(nomeja==""){
    swal({
      title: "ERROR",
      text: "Nomor meja tidak boleh kosong",
      type: "error",
      confirmButtonColor: "#2b5dcd",
      confirmButtonText: "OK",
      closeOnConfirm: true
    });
  }else{
    window.location.href = "tetapkan-nomeja/"+nomeja;
  }
}
