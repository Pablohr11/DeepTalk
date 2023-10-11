function mostrarMenu(){
    var imgMenu = document.querySelector(".displayMenuOculto");
    var menu = document.getElementById("menuOculto");
    var cruz = document.getElementById("cruz");
    menu.classList.toggle("oculto");
    imgMenu.classList.remove("displayMenuOculto");
    cruz.classList.add("displayMenuOculto");
}

function ocultarMenu(){
    var imgMenu = document.getElementById("menu");
    var menu = document.getElementById("menuOculto");
    var cruz = document.getElementById("cruz");
    menu.classList.toggle("oculto");
    imgMenu.classList.add("displayMenuOculto");
    cruz.classList.remove("displayMenuOculto");
}

/*Estas dos funciones se usan para mostrar y ocultar el menu del media en el index*/