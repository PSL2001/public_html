
//


function obtenDatosGen(callback) {
    fetch("https://dog.ceo/api/breeds/image/random")
    .then(response => response.json())
    .then(datos => { imagen.src = datos.message })
}