
//


function obtenDatosGen(url, callback) {
    fetch(url)
    .then(response => response.json())
    .then(datos => { callback(datos); })
}