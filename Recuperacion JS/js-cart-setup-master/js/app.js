function mostrarCarrito(){
    const cartInfo = document.getElementById('cart-info');
    const cart = document.getElementById('cart');

    cartInfo.addEventListener('click', function() {
        cart.classList.toggle('show-cart');
    })
}

function anadirItem(){
    const itemBtnArray = document.querySelectorAll(".store-item-icon");

    itemBtnArray.forEach(function (btnItem){
        btnItem.addEventListener("click", function(event){
            if(event.target.parentElement.classList.contains("store-item-icon")){
                let src = event.target.parentElement.previousElementSibling.getAttribute('src');
                
                src=src.replace("img/", "img-cart/");

                let tarjetaCompleta = event.target.parentElement.parentElement.parentElement;
                let h5= tarjetaCompleta.querySelectorAll("H5"); 
                let nombrePastel = h5[0].textContent;
                let precio = h5[1].textContent; // "$ X"
                precio = precio.slice(1);

                let item = {};
                //CONSTRUYENDO EL OBJETO
                //clave y valor
                item.img = src;
                item.name = nombrePastel;
                item.price = precio;


                console.log(item);
                anadirItemCarrito(item);
            }
        });
    })
}



function anadirItemCarrito(item){


    let nuevoItem = document.createElement("div");

    nuevoItem.classList = "cart-item d-flex justify-content-between text-capitalize my-3";

    let imagen = document.createElement("img");
    imagen.src = item.img;
    imagen.classList = "img-fluid rounded-circle";
    imagen.id = "item-img";

    nuevoItem.appendChild(imagen);


    nuevoItem.innerHTML += `<div class="item-text">

        <p id="cart-item-title" class="font-weight-bold mb-0">${item.name}</p>
        <span>$</span>
        <span id="cart-item-price" class="cart-item-price" class="mb-0">${item.price}</span>
    </div>
    <a href="#" id='cart-item-remove' class="cart-item-remove">
        <i class="fas fa-trash"></i>
    </a>`;
    document.getElementById("cart").prepend(nuevoItem);
    actualizarPrecioTotal();
}

function borrar() {
    let botones = document.getElementById("cart-item-remove");
    for (let i = 0; i < botones.length; i++) {
        let boton = botones[i];
        boton.addEventListener("click", function(evento) {
            let botonclick = evento.target
            botonclick.parentElement.parentElement.remove();
            actualizarPrecioTotal();
        })
    }
}
function actualizarPrecioTotal(){
    let listadoItems = document.querySelectorAll("#cart-item-price");
    let arr=[];
    arr = Object.values(listadoItems);
    //te lo da en cadena por lo que lo convertirmos a float:
    let total = arr.reduce( (acu, item) => acu + parseFloat(item.textContent), 0);
    //tofixed para que solo salgan esa cantidad de decimales.
    document.getElementById("cart-total").textContent = total.toFixed(2);
    
}



anadirItem();
mostrarCarrito();
