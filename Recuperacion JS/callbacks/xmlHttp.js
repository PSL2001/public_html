function httpGet(url) {
    return new Promise ((resolve, reject) => {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", url, false)
        xmlHttp.send(null)

        let respuesta = xmlHttp.responseText;

        if (respuesta != undefined) {
            resolve(respuesta)
        } else {
            reject()
        }
    }); 
}

function random() {
    var promesa = httpGet("https://dog.ceo/api/breeds/image/random")
    promesa.then( (res) => {
        JSON.parse(res);
        var url = res.message;
        var image = document.getElementById("foto2");
        image.src = url
    })
    promesa.catch( (error) => {console.log(error);})
}