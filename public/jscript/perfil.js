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

var pantallaRecurso = document.getElementById("pantallaRecurso");
pantallaRecurso.addEventListener("drop", function(evento){
    var seleccionRecurso = document.getElementById("seleccionRecurso");
    evento.preventDefault();
    if (evento.dataTransfer.items) {
        if (evento.dataTransfer.items[0].kind === "file") {
            seleccionRecurso.files = evento.dataTransfer.files;
        }
    }
});

pantallaRecurso.addEventListener("dragover", function(evento){
    evento.preventDefault();
    evento.stopPropagation();
});