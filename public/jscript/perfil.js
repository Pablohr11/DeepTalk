var contenedorImagenPerfil = document.getElementById("contenedorImagenPerfil");
var panelEditarImagen = document.querySelector("#editarImg");
var pantallaRecurso = document.querySelectorAll("#pantallaRecurso")[0];
var cerrarRecurso = document.getElementById("cerrarRecurso");


contenedorImagenPerfil.addEventListener('mouseover', function(){
    panelEditarImagen.classList.remove("oculto");
});

contenedorImagenPerfil.addEventListener('mouseout', function(){
    panelEditarImagen.classList.add("oculto");
});

contenedorImagenPerfil.addEventListener('click', function(){
    pantallaRecurso.classList.remove("oculto");
});

cerrarRecurso.addEventListener('click', function(){
    let pantallaRecurso = document.getElementById("pantallaRecurso");
    pantallaRecurso.classList.add("oculto");
});