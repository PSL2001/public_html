window.onload = iniciar;

const SELECTED = "seleccionado";
const pelicula = document.getElementById("pelicula");
const contenedor = document.getElementsByClassName("contenedor")[0];


function iniciar() {
    lectura();
    document.getElementsByClassName("contenedor")[0].addEventListener("click", dondeClick);
    pelicula.addEventListener("change", calcularPrecio);
}

function dondeClick(event) {
    if (event.target.className == "asiento") {
        event.target.classList.add("seleccionado");
        document.getElementById("numero").innerHTML++;
        calcularPrecio();
        almacenarAsientos()
    } else if (event.target.className == "asiento seleccionado") {
        event.target.classList.remove("seleccionado");
        document.getElementById("numero").innerHTML--;
        calcularPrecio();
        almacenarAsientos();
    }
}

function calcularPrecio() {
    let precioTotal = document.getElementById("total").innerHTML;
    let cantidadAsientos = document.getElementById("numero").innerHTML;
    let seleccionado = document.getElementById("pelicula").value;

    precioTotal = cantidadAsientos * seleccionado;
    document.getElementById("total").innerHTML = precioTotal;

    //Guardo en storage el precio y los asientos seleccionados
    localStorage.setItem("cantidadAsientos", cantidadAsientos);
    localStorage.setItem("precioTotal", precioTotal);
    localStorage.setItem("pelicula", seleccionado);
}

function almacenarAsientos() {
    let asientos = contenedor.querySelectorAll(".asiento")
    let asientoseleccionado = [];
    for (let i = 0; i < asientos.length; i++) {
        if (asientos[i].classList.contains("seleccionado")) {
            asientoseleccionado.push(i);
        }
    }
    localStorage.setItem(SELECTED, JSON.stringify(asientoseleccionado));
}

function lectura() {
    //Asientos
    let asientoseleccionado = JSON.parse(localStorage.getItem(SELECTED));
    let asientos = contenedor.querySelectorAll(".asiento");

    for (let i = 0; i < asientoseleccionado.length; i++) {
        asientos[asientoseleccionado[i]].classList.add("seleccionado");
    }

    //pelicula

    //Precio total y cantidad de asientos
    let precio = localStorage.getItem("preciototal");
    document.getElementById("total").innerHTML = precio;
    let cantidad = localStorage.getItem("cantidadAsientos");
    document.getElementById("numero").innerHTML = cantidad;
}