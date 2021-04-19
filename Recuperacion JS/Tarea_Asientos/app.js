let contenedores = document.getElementsByClassName("contenedor");

window.onload = iniciar;

function iniciar() {
    contenedores[0].addEventListener("click", dondeClick);
}

function dondeClick(event) {

    if (event.target.className == "asiento") {
        if (event.target.className == "asiento.ocupado") {
            
        }
    }
    console.log(event.target);
}