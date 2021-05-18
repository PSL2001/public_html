function doSomething () {
    return new Promise ((resolve, reject) => {
        let a = Math.random * 10;
        if (a < 5)
            reject (new Error ("Errorazo"));
        else
            resolve (a);
    });
}

doSomething().then((num) => console.log(num))
.catch( (error) => {console.log(error)});