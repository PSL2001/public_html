
window.onload = iniciar;
let padre;
function iniciar() {
    obtenerDatos();
    padre = document.getElementById("store-items");
}

function obtenerDatos() {
    fetch("./datos.json")
    .then(function(response) {
        return response.json();
    })
    .then(function(texto) {
        añadirPastel(texto);
    })
}

function añadirPastel(content) {
    for (let i = 0; i < content.pastelitos.length; i++) {

        let nuevocontent = `
        <div class="col-10 col-sm-6 col-lg-4 mx-auto my-3 store-item sweets" data-item="sweets">
        <div class="card ">
          <div class="img-container">
            <img src=${content.pastelitos[i].src} class="card-img-top store-img" alt="">
            <span class="store-item-icon">
              <i class="fas fa-shopping-cart"></i>
            </span>
          </div>
          <div class="card-body">
            <div class="card-text d-flex justify-content-between text-capitalize">
              <h5 id="store-item-name">${content.pastelitos[i].nombre}</h5>
              <h5 class="store-item-value">$ <strong id="store-item-price" class="font-weight-bold">${content.pastelitos[i].precio}</strong></h5>
            </div>
          </div>
        </div>`;
        //Añadiendo HMTL al final de todo lo que tiene el contenedor padre
        padre.innerHTML += nuevocontent;
    }
}


/*
<div class="col-10 col-sm-6 col-lg-4 mx-auto my-3 store-item sweets" data-item="sweets">
          <div class="card ">
            <div class="img-container">
              <img src="img/sweets-1.jpeg" class="card-img-top store-img" alt="">
              <span class="store-item-icon">
                <i class="fas fa-shopping-cart"></i>
              </span>
            </div>
            <div class="card-body">
              <div class="card-text d-flex justify-content-between text-capitalize">
                <h5 id="store-item-name">sweet item</h5>
                <h5 class="store-item-value">$ <strong id="store-item-price" class="font-weight-bold">5</strong></h5>
              </div>
            </div>
          </div>
*/