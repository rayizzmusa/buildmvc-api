function myFunction() {
  let input, filter, ul, li, a, i;

  input = document.getElementById("mysearch");
  filter = input.value.toUpperCase();
  ul = document.getElementById("mymenu");
  li = ul.getElementsByTagName("li");

  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    if (a.innerText.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

let search = document.getElementById('mysearch');
search.addEventListener('keyup', myFunction);


function edit(mode){
  if (mode == "update"){
    document.getElementById('mode').value = "update";
    document.getElementById('form').submit();
  } else {
    Swal.fire({
      icon: "warning",
      title: "Konfirmasi",
      text: "Yakin mau dihapus?",
      showCancelButton: true,
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
      reverseButtons: true,
    }).then((result) => {
      if(result.isConfirmed){
        document.getElementById("mode").value = "delete";
        document.getElementById("form").submit();
      } else if (result.dismiss === Swal.DismissReason.cancel){
          return false;
        }
    });


  }
}