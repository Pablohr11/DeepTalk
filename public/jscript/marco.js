function desplegar(pestañaDesplegar){
    var deplegables = document.getElementById("barraLateral").querySelector("ul");
    var contenedorDesplegar = deplegables.querySelectorAll("div")[pestañaDesplegar];
    contenedorDesplegar.classList.toggle("oculto");
    contenedorDesplegar.classList.toggle("desplegableVisible");
}

var nombreDeConversacion = document.getElementById("nombreDeConversacion");
var botonesDeConversaciones = document.getElementsByClassName("Button");

for(let botonConversacion of botonesDeConversaciones){
    botonConversacion.addEventListener('click', function(){
        nombreDeConversacion.innerHTML = botonConversacion.innerHTML;
    });
}

var coleccioneBotonesMas = document.getElementsByClassName("addDivButton");

for(let botonesMas of coleccioneBotonesMas){
    botonesMas.addEventListener('click', function(){
        if (botonesMas == coleccioneBotonesMas[0]) {
            nombreDeConversacion.innerText = "Crear Chat";
        } else if (botonesMas == coleccioneBotonesMas[1]) {
            nombreDeConversacion.innerText = "Crear Grupo";
        }
    });
}