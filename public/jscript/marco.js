function desplegar(pestañaDesplegar){
    var deplegables = document.getElementById("barraLateral").querySelector("ul");
    var contenedorDesplegar = deplegables.querySelectorAll("div")[pestañaDesplegar];
    contenedorDesplegar.classList.toggle("oculto");
    contenedorDesplegar.classList.toggle("desplegableVisible");
}

var nombreDeConversacion = document.getElementById("nombreDeConversacion")
var botonesDeConversaciones = document.getElementsByClassName("Button");

for(let botonConversacion of botonesDeConversaciones){
    botonConversacion.addEventListener('click', function(){
        nombreDeConversacion.innerText = botonConversacion.innerText;
    });
}