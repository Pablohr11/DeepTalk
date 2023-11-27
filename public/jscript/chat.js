

function init() {
    var objDiv = document.getElementById("contenido");
    objDiv.scrollTop = objDiv.scrollHeight;
    var caja = document.getElementById("cajaMensaje");
    caja.focus();
}

function showMessage(message, nombreRemitente, userId) {
    var container = document.getElementById("mensajes");
    container.innerHTML+= '<div class="mensaje '+ ((userId != message[0])?'ajeno':'propio') +'"><div class="remitente">'+nombreRemitente+'</div><label class="texto">'+message[4]+'</label></div>';

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