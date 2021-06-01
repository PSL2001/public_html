

const boton=document.getElementById("boton2");

function iniciar2(){
    boton.addEventListener("click",llamada2);
}

function vaciarContenedor(){
    let contenedor=document.getElementById("imagenesRequest");
    while (contenedor.firstChild) {
        contenedor.removeChild(contenedor.firstChild);
    }
}

function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false para request syncrono 
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

function llamada2(){
    
    let contenedor=document.getElementById("imagenesRequest");
    let imgs=contenedor.getElementsByTagName("img");

    if(imgs.length>0){
        vaciarContenedor();
    }
    
    for(let i=0;i<3;i++){
        var json = httpGet('https://dog.ceo/api/breeds/image/random');
        var array = JSON.parse(json);
        var url = array.message;
        pintarImagen2(url);
    }
}//FINLlamada

function pintarImagen2(url){
    //Cogemos el contenedor donde pintaremos la imagen
    let contenedor=document.getElementById("imagenesRequest");
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