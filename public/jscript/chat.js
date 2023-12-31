function init() {
    var objDiv = document.getElementById("contenido");
    objDiv.scrollTop = objDiv.scrollHeight;
    var caja = document.getElementById("cajaMensaje");
    caja.focus();
}

function obtenerHoraDeFecha(fecha){
    return fecha.substring(11,16);
}

function showMessage(message, nombreRemitente, userId) {
    var container = document.getElementById("mensajes");
    var html = '<div class="mensaje '+ ((userId != message[0])?'ajeno':'propio') +'"><div class="remitente">'+nombreRemitente+'</div><pre class="contenedorTexto">';
    

    if(message[5]==="texto"){
        html+= '<span class="texto">'+message[4]+'</span></pre><div class="horaMensaje"><span>'+obtenerHoraDeFecha(message[3])+'</span></div></div>';
    }else if(message[5]==="imagen"){
        html+= '<img class="imagen" src="'+message[4]+'"></img></pre><div class="horaImagen"><span>'+obtenerHoraDeFecha(message[3])+'</span></div></div>';
    }
    container.innerHTML+= html;

    var objDiv = document.getElementById("contenido");
    objDiv.scrollTop = objDiv.scrollHeight;
}

function showGroupMessage(message, arrayUsuarios, userId) {
    var container = document.getElementById("mensajes");
    var html = '<div class="mensaje '+ ((userId != message[0])?'ajeno':'propio') +'"><div class="remitente">'+arrayUsuarios[message[0]]+'</div><pre class="contenedorTexto">';


    if(message[5]==="texto"){
        html+= '<span class="texto">'+message[4]+'</span></pre><div class="horaMensaje"><span>'+obtenerHoraDeFecha(message[3])+'</span></div></div>';
    }else if(message[5]==="imagen"){
        html+= '<img class="imagen" src="'+message[4]+'"></img></pre><div class="horaImagen"><span>'+obtenerHoraDeFecha(message[3])+'</span></div></div>';
    }
    container.innerHTML+= html;

    var objDiv = document.getElementById("contenido");
    objDiv.scrollTop = objDiv.scrollHeight;
}

const barraMensaje = document.getElementById("cajaMensaje");
barraMensaje.addEventListener('input', function(){
    barraMensaje.style.height = "2rem";
    barraMensaje.style.height = (barraMensaje.scrollHeight + 2) +"px";
});

var botonEnviarMsg = document.getElementById("enviarMsg");
botonEnviarMsg.addEventListener('click', function(){
    document.getElementById("formulario").submit();
});

var caja = document.getElementById("cajaMensaje");
caja.addEventListener('keypress', function(event) {
    if(event.code == "Enter" && !event.shiftKey){
        event.preventDefault();
        event.stopPropagation();
        document.getElementById("formulario").submit();
    }
});

var enviarRecurso = document.getElementById("enviarRecurso");
enviarRecurso.addEventListener('click', function(){
    let pantallaRecurso = document.getElementById("pantallaRecurso");
    pantallaRecurso.classList.remove("oculto");
});

var cerrarRecurso = document.getElementById("cerrarRecurso");
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
    pantallaRecurso.classList.remove("bordeArrastraArchivo");
    let interfazRecurso = document.getElementById("interfazRecurso");
    interfazRecurso.classList.remove("oculto");
});

pantallaRecurso.addEventListener("dragover", function(evento){
    evento.preventDefault();
    evento.stopPropagation();
    pantallaRecurso.classList.add("bordeArrastraArchivo");
    let interfazRecurso = document.getElementById("interfazRecurso");
    interfazRecurso.classList.add("oculto");
});

pantallaRecurso.addEventListener("dragleave", function(evento){
    evento.preventDefault();
    evento.stopPropagation();
    pantallaRecurso.classList.remove("bordeArrastraArchivo");
    let interfazRecurso = document.getElementById("interfazRecurso");
    interfazRecurso.classList.remove("oculto");
});

var imagenes = document.querySelectorAll(".imagen");
imagenes.forEach(image => {
    image.addEventListener('click', function() {
        document.getElementById("imagenAmpliada").src = image.src;
        document.getElementById("descargarImagen").href = image.src;
        let pantallaImagen = document.getElementById("pantallaImagen");
        pantallaImagen.classList.remove("oculto");
        
    });
});

var cerrarImagen = document.getElementById("cerrarImagen");
cerrarImagen.addEventListener('click', function(){
    let pantallaImagen = document.getElementById("pantallaImagen");
    pantallaImagen.classList.add("oculto");
});
