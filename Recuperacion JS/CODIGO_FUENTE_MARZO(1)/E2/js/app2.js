window.onload=iniciar;

const buttons=document.querySelector(".sortBtn");

function iniciar(){
    buttons.addEventListener("click",filtrar);
}

//Hemos añadido en el archivo all.css una clase llamada .hidden{display:none;}
function filtrar(e){
    //Si el elemento clickeado es un <a></a>
    if(e.target.tagName.toLowerCase() === "a"){
        //Cogemos la lista entera de pasteles y sus divs
        const lista=document.querySelectorAll('.store-item');
        //Cogemos el dato que estamos filtrando
        let filtrado=e.target.dataset.filter;

        //Si el filtro es all removemos la clase hidden
        if(filtrado==="all"){
            lista.forEach(pastel => {
                if(pastel.classList.contains('hidden'))
                    pastel.classList.remove('hidden');
            });
        }else{
            for(let i=0;i<lista.length;i++){
                if(lista[i].dataset.item==filtrado){
                    //Si el pastel contiene la clase que queremos filtrar
                    //removemos la clase hidden
                    lista[i].classList.remove('hidden');
                }else{
                    //Si no contiene la clase filtrada añadimos la clase hidden
                    lista[i].classList.add('hidden');
                }
            }
        }
    }//Si no es un elemento <a></a> no hacemos nada

}//FINFiltrado