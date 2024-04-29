function desplegar(pestañaDesplegar){
    var deplegables = document.getElementById("barraLateral").querySelector("ul");
    var contenedorDesplegar = deplegables.querySelectorAll("div")[pestañaDesplegar];
    contenedorDesplegar.classList.toggle("oculto");
    contenedorDesplegar.classList.toggle("desplegableVisible");
}

var nombreDeConversacion = document.getElementById("nombreDeConversacion");
var botonesDeConversaciones = document.getElementsByClassName("Button");

for(let botonConversacion of botonesDeConversaciones){
    botonConversacion.addEventListener('click', function(){
        let nombreDelUsuario = botonConversacion.querySelector(".nombreUsuario").innerText;
        nombreDeConversacion.innerHTML = "<a class='hiperVinculoPerfilAjeno' href='../pages/perfil.php?usuarioPropietario="+nombreDelUsuario+"'>"+ botonConversacion.innerHTML +"</a>";
    });
}

var coleccioneBotonesMas = document.getElementsByClassName("addDivButton");

for(let botonesMas of coleccioneBotonesMas){
    botonesMas.addEventListener('click', function(){
        if (botonesMas == coleccioneBotonesMas[0]) {
            nombreDeConversacion.innerText = "Crear Chat";
        } else if (botonesMas == coleccioneBotonesMas[1]) {
            nombreDeConversacion.innerText = "Crear Grupo";
        }
    });
}

var contendedorLogo = document.getElementById("contendedorLogo");
var barraLateral = document.getElementById("barraLateral");
var perfil = document.getElementById("perfil");

var botonesConversacionales = document.getElementsByClassName("marcoButton");
for(let botonConversacion of botonesConversacionales){
    botonConversacion.addEventListener('click', function(){
        contendedorLogo.classList.remove("visible");
        barraLateral.classList.remove("visible");
        perfil.classList.remove("visibleFlex");
    });
}

var flechaOcultarChats = document.getElementById("flechaOcultarChats");
flechaOcultarChats.addEventListener('click', function(){
    contendedorLogo.classList.remove("visible");
    barraLateral.classList.remove("visible");
    perfil.classList.remove("visibleFlex");
});

var flechaMostrarChats = document.getElementById("flechaMostrarChats");
flechaMostrarChats.addEventListener('click', function(){
    contendedorLogo.classList.add("visible");
    barraLateral.classList.add("visible");
    perfil.classList.add("visibleFlex");
});