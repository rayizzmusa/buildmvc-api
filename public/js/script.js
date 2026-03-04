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
