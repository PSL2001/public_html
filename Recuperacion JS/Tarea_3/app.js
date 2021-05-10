window.onload=iniciar;

const boton=document.getElementById("anadir");

function iniciar(){
    boton.addEventListener("click",anadir);
}

function anadir(){
    //Leemos los datos
    let texto=document.getElementById("texto").value;
    let cantidad=parseInt(document.getElementById("cantidad").value);

    //Escribimos los datos
    let balance=parseInt(document.getElementById("balance").textContent);
    let positivo=parseInt(document.getElementById("dinero-positivo").textContent);
    let negativo=parseInt(document.getElementById("dinero-negativo").textContent);
    //Boolean que dirá si es positivo o negativo
    let interrup=false;
    

    if(texto<=0){
        alert("El campo de texto está vacío");
    }else if(isNaN(cantidad)){
        alert("Debe incluir algún valor");
    }else{
        //Si no pasa nada de lo anterior tratamos los datos
        if(cantidad >0){
            let suma= balance + cantidad;
            let sumaPositivo = positivo + cantidad;
            document.getElementById("balance").textContent = `${suma}€`;
            document.getElementById("dinero-positivo").textContent = `${sumaPositivo}€`;
            interrup= true;
            pintarEnLista(interrup, texto, cantidad);
        }else{
            let resta= balance + cantidad;
            let restaNegativo = negativo + cantidad;
            document.getElementById("balance").textContent = `${resta}€`;
            document.getElementById("dinero-negativo").textContent = `${restaNegativo}€`;
            interrup= false;
            pintarEnLista(interrup, texto, cantidad);
        }
        for(let i=0;i<document.querySelectorAll('#lista .eliminar-btn').length;i++){
            document.querySelectorAll('#lista .eliminar-btn')[i].addEventListener("click",eliminar);
        }    
    }
}

function pintarEnLista(interruptor,texto,cantidad){
    let lista=document.getElementById("lista");
    let li=document.createElement("li");
    let span=document.createElement("span");
    let button=document.createElement("button");
    //Referencia al li
    if(interruptor==true){
        li.setAttribute("class","positivo");
    }else{
        li.setAttribute("class","negativo");
    }
    li.innerHTML = texto;
    lista.appendChild(li);
    //Referencia al span
    span.innerHTML=`${cantidad}€`;
    li.appendChild(span);
    //Boton
    button.setAttribute("class","eliminar-btn");
    button.innerHTML="X";
    li.appendChild(button);
}

function eliminar(event){
    let nodoPapiChulo=event.target.parentNode;
    let cantidad=parseInt(nodoPapiChulo.getElementsByTagName("span")[0].textContent);

    let balance=parseInt(document.getElementById("balance").textContent);
    let positivo=parseInt(document.getElementById("dinero-positivo").textContent);
    let negativo=parseInt(document.getElementById("dinero-negativo").textContent);

    //Ejecucion
    if(cantidad>0){
        interruptor=true;
        let suma=balance-cantidad;
        let sumaPositivo=positivo-cantidad;
        document.getElementById("balance").textContent=`${suma}€`;
        document.getElementById("dinero-positivo").textContent=`+${sumaPositivo}€`;
    }else{
        let resta=balance-cantidad;
        let restaNegativo=negativo-cantidad;
        document.getElementById("balance").textContent=`${resta}€`;
        document.getElementById("dinero-negativo").textContent=`${restaNegativo}€`;

    }
    //Por ultimo removemos el nodo
    let lista=document.getElementById("lista");

    lista.removeChild(event.target.parentNode);
}