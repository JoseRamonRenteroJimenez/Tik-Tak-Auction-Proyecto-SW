$(document).ready(function() {
const tipoSubasta = document.getElementById("tipoSubasta");
const intervalos = document.getElementById("intervalos");

tipoSubasta.addEventListener("change", () => {
  if (tipoSubasta.value === "Holandesa") {
    intervalos.style.display = "block";
    
  } else {
    intervalos.style.display = "none";  
    
}
});
})