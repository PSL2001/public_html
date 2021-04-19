//Cogemos el id de la x
let cruz = document.getElementById("closeconsentimientoCookies");
//Cogemos el boton
let boton = document.getElementsByClassName("consentimientoCookiesOK"); 
//Nota: getElementsByClassName devuelve un array
//Cogemos el div
let div = document.getElementById("consentimientoCookies");


window.onload = iniciar(); //cuando cargue la pagina, llama a iniciar

function iniciar() { 
    //Iniciar revisa primero que en el storage exista un item llamado "aceptada", 
    //suponiendo que ese sea el caso o no crea los eventlisteners de boton y cruz
    let cookies = localStorage.getItem("aceptada");
    if (cookies == "true") { //Si esa variable tiene de valor "true" oculta el div
        div.style = "display: none;";
    }
    cruz.addEventListener("click", cerrar);//Si pulsamos la x ocultamos el div
    boton[0].addEventListener("click", cerrar); //Si pulsamos aceptar condiciones el div se oculta y no se vuelve a mostrar mas
}

function cerrar(_e) {
    //Cerrar primero revisa que el objetivo sea boton[0], dado que este es el boton de aceptar cookies
    if (_e.currentTarget == boton[0]) { //Suponiendo que ese es el caso:
        localStorage.setItem("aceptada", "true"); //Crea un item en el almacenamiento local llamado "aceptada" que tiene el valor de "true"
    }
    if (div.style != "display: none;") {
        div.style = "display: none;";
    } else {
        div.style = "display: block;";
    }
    //Por último oculta el div
}


