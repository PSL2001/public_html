let contenedores = document.getElementsByClassName("contenedor");

window.onload = iniciar;

function iniciar() {
    contenedores[0].addEventListener("click", dondeClick);
}

function dondeClick(event) {

    if (event.target.class == "asiento") {
        event.target.class += ".seleccionado";
    }
    console.log(event.target);
}