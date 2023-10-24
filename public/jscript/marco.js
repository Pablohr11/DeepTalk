function desplegar(pestañaDesplegar){
    var deplegables = document.getElementById("barraLateral").querySelector("ul");
    var contenedorDesplegar = deplegables.querySelectorAll("div")[pestañaDesplegar];
    contenedorDesplegar.classList.toggle("oculto");
    contenedorDesplegar.classList.toggle("visible");
}