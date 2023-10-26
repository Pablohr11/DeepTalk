function desplegar(pestañaDesplegar){
    var deplegables = document.getElementById("barraLateral").querySelector("ul");
    var contenedorDesplegar = deplegables.querySelectorAll("div")[pestañaDesplegar];
    contenedorDesplegar.classList.toggle("oculto");
    contenedorDesplegar.classList.toggle("visible");

    var simbolo = document.getElementById("simbolo0");
    simbolo.classList.toggle("rotado");
    simbolo.style.transform = 'rotate(90deg)';

}