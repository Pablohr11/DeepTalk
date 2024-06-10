function mostrarMenu(){
    var menu = document.getElementById("menuOculto");
    var top = document.querySelector(".top");
    var mid = document.querySelector(".middle");
    var bot = document.querySelector(".bottom");
    menu.classList.toggle("oculto");
    if(mid.classList.contains("oculto")){
        top.style.transform = "translateY(0px) rotateZ(0deg)";
        mid.classList.remove("oculto");
        bot.style.transform = "translateY(0px) rotateZ(0deg)";
    }else{
        top.style.transform = "translateY(12px) rotateZ(45deg)";
        mid.classList.add("oculto");
        bot.style.transform = "rotateZ(-45deg)";
    }
}


/*Estas funciones se usa para mostrar y ocultar el menu del media en el index*/

function enableDarkMode() {
    var theme = getCookieValue("theme");
    if (theme == "dark") {
    }
}

function getCookieValue(name) {
    const regex = new RegExp(`(^| )${name}=([^;]+)`)
    const match = document.cookie.match(regex)
    if (match) {
        return match[2]
    }
}


/*Esta funcion creará y mostrará un popUP*/

const tiempoPorDefectoDelPopUp = 6000;

function crearMostrarPopUp(estadoDelPopUp, mensajeDelPopUp, tiempoEnPantallaDelPopUp){
    let contenido = document.getElementById("contenido");
    let popUp = document.createElement("div");
    popUp.setAttribute("id", "popUp");
    if(estadoDelPopUp == "correcto"){
        popUp.innerHTML = "<img class='imagenEstado' src='../resources/correcto.png'/> <span>"+ mensajeDelPopUp +"</span>";
        popUp.setAttribute("class", "popUpPerfecto");
    }else if(estadoDelPopUp == "advertencia"){
        popUp.innerHTML = "<img class='imagenEstado' src='../resources/advertencia.png'/> <span>"+ mensajeDelPopUp +"</span>";
        popUp.setAttribute("class", "popUpRegulero");
    }else if(estadoDelPopUp == "error"){
        popUp.innerHTML = "<img class='imagenEstado' src='../resources/error.png'/> <span>"+ mensajeDelPopUp +"</span>";
        popUp.setAttribute("class", "popUpError");
    }
    contenido.appendChild(popUp);
    setTimeout(function(){
        let popUpBorrar = document.getElementById("popUp");
        contenido.removeChild(popUpBorrar);
    },tiempoEnPantallaDelPopUp);
}