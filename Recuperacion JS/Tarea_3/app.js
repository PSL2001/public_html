window.onload = iniciar;



const boton = document.getElementById("anadir");

function iniciar() {
    boton.addEventListener("click", calcular);
    
}

function calcular() {
    //Variables de lectura
    let texto = document.getElementById("texto").value;
    let cantidad = parseInt(document.getElementById("cantidad").value);
    //Variables de escritura
    let balance =parseInt(document.getElementById("balance").textContent);
    let dineroPos =parseInt(document.getElementById("dinero-positivo").textContent);
    let dineroNeg = parseInt(document.getElementById("dinero-negativo").textContent);
    
    let interruptor = false;
    //ejecucion
    if (texto <= 0 ) {
        alert("El campo de texto esta vacio o debe de ser un valor identificativo (texto)");
    } else if (cantidad == 0) {
        alert("La cantidad debe de ser menor o mayor a 0");
    }else {
        //Si nada de lo anterior ocurre tratamos los datos
        if (cantidad > 0) {
            interruptor = true;
            let suma = balance + cantidad;
            let sumaPos = dineroPos + cantidad; 
            document.getElementById("balance").textContent = `${suma}€`;
            document.getElementById("dinero-positivo").textContent = `+${sumaPos}€`
            //Ya hemos tratado los valores ahora hay que añadirlos a la lista
            pintarLista(interruptor, texto, cantidad);
            document.getElementsByClassName("eliminar-btn")[0].addEventListener("click", borrar);

        } else {
            let resta = balance + cantidad;
            let restaNega = dineroNeg + cantidad;
            document.getElementById("balance").textContent = `${resta}€`;
            document.getElementById("dinero-negativo").textContent = `${restaNega}€`;
            //Ya hemos tratado los valores ahora hay que añadirlos a la lista
            pintarLista(interruptor, texto, cantidad);
            document.getElementsByClassName("eliminar-btn")[0].addEventListener("click", borrar);
        }
    }
}//Fin del añadir

function pintarLista(interruptor, nombre, cantidad) {
    let lista = document.getElementById("lista");

    let li = document.createElement("li");
    let span = document.createElement("span");
    let button = document.createElement("button");
    if (interruptor == true) {
        li.setAttribute("class", "positivo");
    } else {
        li.setAttribute("class", "negativo");
    }
    li.innerHTML = nombre;
    lista.appendChild(li);

    span.innerHTML = `${cantidad}€`
    li.appendChild(span);

    button.setAttribute("class", "eliminar-btn");
    button.innerHTML = "X";
    li.appendChild(button);

}

function borrar(event) {
    let lista = document.getElementById("lista");
    let padre = event.target.parentNode;
    let cantidad = parseInt(padre.getElementsByTagName("span")[0].textContent)
    console.log(cantidad);
    

    //Por Ultimo borramos el elemento
    lista.removeChild(event.target.parentNode);
}