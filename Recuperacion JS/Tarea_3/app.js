window.onload = iniciar;



const boton = document.getElementById("anadir");
const eliminar = document.getElementsByClassName("eliminar-btn");

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
    let lista = document.getElementById("lista");
    
    //ejecucion
    if (texto <= 0 ) {
        alert("El campo de texto esta vacio o debe de ser un valor identificativo (texto)");
    } else if (cantidad == 0) {
        alert("La cantidad debe de ser menor o mayor a 0");
    }else {
        //Si nada de lo anterior ocurre tratamos los datos
        if (cantidad > 0) {
            let suma = balance + cantidad;
            let sumaPos = dineroPos + cantidad; 
            document.getElementById("balance").textContent = `${suma}€`;
            document.getElementById("dinero-positivo").textContent = `+${sumaPos}€`
            //Ya hemos tratado los valores ahora hay que añadirlos a la lista
        } else {
            let resta = balance + cantidad;
            let restaNega = dineroNeg + cantidad;
            document.getElementById("balance").textContent = `${resta}€`;
            document.getElementById("dinero-negativo").textContent = `${restaNega}€`;
            //Ya hemos tratado los valores ahora hay que añadirlos a la lista
        }
    }
}//Fin del añadir