window.onload=iniciar;

const button=document.getElementById("boton1");
function iniciar(){
    button.addEventListener("click",llamada);
}

function llamada(){
    //Cogemos el contenedor donde pintaremos la imagen
    let contenedor=document.getElementById("imagenesFetch");

    let imgs=contenedor.getElementsByTagName("img");
    if(imgs.length>0){
        while (contenedor.firstChild) {
            contenedor.removeChild(contenedor.firstChild);
        }
    }
    
    fetch("https://dog.ceo/api/breeds/image/random")
    .then(response => response.json())
    .then(datos=>{
        let imagen=String(datos.message);
        pintarImagen(imagen);       
    });
    fetch("https://dog.ceo/api/breeds/image/random")
    .then(response => response.json())
    .then(datos=>{
            let imagen=String(datos.message);
            pintarImagen(imagen);       
    });
    fetch("https://dog.ceo/api/breeds/image/random")
    .then(response => response.json())
    .then(datos=>{
            let imagen=String(datos.message);
            pintarImagen(imagen);       
    });
    

    
}

function pintarImagen(url){
    //Cogemos el contenedor donde pintaremos la imagen
    let contenedor=document.getElementById("imagenesFetch");
    //Creamos el objeto imagen
    let img=document.createElement("img");
    //Le añadimos la url a img
    img.src=String(url);
    img.width=200;
    img.height=200;
    img.title="Sabia que mirarias esto o.o";
    //añadimos el objeto a su contenedor
    contenedor.appendChild(img);
}