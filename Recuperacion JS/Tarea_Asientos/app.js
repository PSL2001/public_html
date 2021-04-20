window.onload = iniciar;

const pelicula = document.getElementById("pelicula");

function iniciar() {
    document.getElementsByClassName("contenedor")[0].addEventListener("click", dondeClick);
    pelicula.addEventListener("change", calcularPrecio);
}

function dondeClick(event) {
    if (event.target.className == "asiento") {
        event.target.classList.add("seleccionado");
        document.getElementById("numero").innerHTML++;
        calcularPrecio();
    } else if (event.target.className == "asiento seleccionado") {
        event.target.classList.remove("seleccionado");
        document.getElementById("numero").innerHTML--;
        calcularPrecio();
    }
}

function calcularPrecio() {
    let precioTotal = document.getElementById("total").innerHTML;
    let cantidadAsientos = document.getElementById("numero").innerHTML;
    let seleccionado = document.getElementById("pelicula").value;

    precioTotal = cantidadAsientos * seleccionado;
    document.getElementById("total").innerHTML = precioTotal;

}