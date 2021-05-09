window.onload = iniciar;

const buttons = document.querySelector(".sortBtn");

function iniciar() {
    buttons.addEventListener("click", filtrar);
}

//Hemos añadido en el archivo all.css una clase llamada .hidden{display:none;}
function filtrar(e) {
    //Si el elemento clickeado es un <a></a>
    if (e.target.tagName.toLowerCase() === "a") {
        //Cogemos la lista entera de pasteles y sus divs
        const lista = document.querySelectorAll('.store-items div');
        //Cogemos el dato que estamos filtrando
        let filtro = e.target.dataset.filter;

        //Si el filtro es all removemos la clase hidden
        if (filtro === "all") {
            lista.forEach(producto => producto.classList.remove('hidden'));
        } else {
            //Pasamos por la lista de pasteles
            lista.forEach(producto => {
                if (producto.classList.contains(filtro)) {
                    //Si el producto contiene la clase que queremos filtrar
                    //removemos la clase hidden
                    producto.classList.remove('hidden');
                } else {
                    //Si no contiene la clase filtrada añadimos la clase hidden
                    producto.classList.add('hidden');
                }
            });
        }
    }//Si no es un elemento <a></a> no hacemos nada

}//FINFiltrado