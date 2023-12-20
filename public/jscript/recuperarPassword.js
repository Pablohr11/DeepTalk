var formularioCambio = document.getElementById("formularioCambio");
formularioCambio.addEventListener('submit', function(evento){
    evento.preventDefault();
    evento.stopPropagation();
    let primeraPassword = document.getElementById("primeraPassword");
    let segundaPassword = document.getElementById("segundaPassword");

    if(primeraPassword.value === segundaPassword.value){
        formularioCambio.submit();
    }else{
        let textoError = document.getElementById("textoError");
        textoError.innerText = "Las contraseñas no coinciden.";
    }
});