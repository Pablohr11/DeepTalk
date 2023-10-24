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