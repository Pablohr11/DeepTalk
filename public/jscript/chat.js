function init() {

    var objDiv = document.getElementById("contenido");
    objDiv.scrollTop = objDiv.scrollHeight;


    var caja = document.getElementById("cajaMensaje");

    var inpu = document.getElementById("mensajeEscrito");

    caja.addEventListener('keypress', function(event) {
        if (event.code == "Enter") {
            inpu.value = caja.textContent;
            document.getElementById("formulario").submit();
        }
    })
}


 