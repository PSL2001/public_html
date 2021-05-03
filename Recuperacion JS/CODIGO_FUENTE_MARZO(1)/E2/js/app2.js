window.onload = iniciar;

let contenedorBTN;

function iniciar() {
    contenedorBTN = document.querySelector(".sortBtn");
    contenedorBTN.addEventListener("click", filtrar);
}

function filtrar(event) {
    if (event.target.tagName.toLowerCase() === "a") {
        console.log("estoy cogiendo el boton");
    } else {
        console.log("no estoy cogiendo el boton");
    }
}