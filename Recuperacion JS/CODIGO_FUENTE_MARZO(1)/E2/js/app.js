//Cogemos la barra de busqueda
let barra = document.getElementById("search-item");
//cogemos la lupa
let lupa = document.getElementById("search-icon");

window.onload = iniciar();

function iniciar() {
    lupa.addEventListener("click", buscar);
}

function buscar() {
    let busqueda = barra.value;
    console.log(busqueda);

    let padre = document.getElementById("store-items");

    if (padre.children.length > 0) {
        for (let i = 0; i < padre.children.length; i++) {
            //forma 1 let nombre= padre.children[i].firstElementChild.lastElementChild.firstElementChild.firstElementChild.textContent;
            let pastel = padre.children[i];
            let nombre = pastel.getElementsByTagName("h5")[0].textContent;
            console.log(nombre);

            if (nombre.includes(busqueda)) {
                pastel.style.display = 'block';
            } else {
                pastel.style.display = 'none';
            }
            
        }
    }
}