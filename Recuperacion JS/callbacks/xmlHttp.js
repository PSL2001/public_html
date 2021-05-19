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

