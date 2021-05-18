function tareaPesada(tiempo) {
    return new Promise((resolve, reject) => {
       setTimeout( function () {
           let num = 3;

           if (num < 4) {
               //Si es <4 peta
               reject();
           } else {
               //Si es igual o mayor lo devuelvo
               resolve(num);
           }
       }, tiempo) 
    });
}

tareaPesada(3000)
.then( (numero) => {console.log("El numero esperado es" + numero);})
.catch(() => {console.log("No hay numero prometido");})