function navBar(){
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
}



function profil() {
  if (document.getElementById("profil").style.display=="none") {
   document.getElementById("profil").style.display = "block";
 }else{
   document.getElementById("profil").style.display = "none";
 }
 }

function openForm() {
 if (document.getElementById("connexion").style.display=="none") {
  document.getElementById("connexion").style.display = "block";
}else{
  document.getElementById("connexion").style.display = "none";
}
}

function closeForm() {
  document.getElementById("connexion").style.display = "none";
}


function openForm2() {

  if ( document.getElementById("inscription").style.display=="none") {
   document.getElementById("inscription").style.display = "block";
 }else{
   document.getElementById("inscription").style.display = "none";
 }
 }
 
 function closeForm2() {
   document.getElementById("inscription").style.display = "none";
 }

