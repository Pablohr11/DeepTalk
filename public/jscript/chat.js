

function init() {

    var objDiv = document.getElementById("contenido");
    objDiv.scrollTop = objDiv.scrollHeight;


    var caja = document.getElementById("cajaMensaje");

    var inpu = document.getElementById("mensajeEscrito");

    caja.addEventListener('keypress', function(event) {
        if (event.code == "Enter" && !event.shiftKey) {
            event.preventDefault();
            inpu.value = caja.textContent;
            document.getElementById("formulario").submit();
        }
    });

    var botonEnviarMsg = document.getElementById("enviarMsg");
    botonEnviarMsg.addEventListener('click', function(event) {
        inpu.value = caja.textContent;
        document.getElementById("formulario").submit();
    });
}

function showMessage(message, nombreRemitente, userId) {
    var container = document.getElementById("mensajes");
    
    
    container.innerHTML+= '<div class="mensaje '+ ((userId != message[0])?'ajeno':'propio') +'"><div class="remitente">'+nombreRemitente+'</div><label class="texto">'+message[4]+'</label></div>';

    var objDiv = document.getElementById("contenido");
    objDiv.scrollTop = objDiv.scrollHeight;
}
