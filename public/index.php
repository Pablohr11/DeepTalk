<?php 

    include("../storage/classes/DbConector.php");
    include("../storage/data.php");
    require_once("../storage/classes/CurrentUser.php");
    include("../config/themes.php");

    $userSet = false;

    session_start();
    if (isset($_SESSION["user"])) {
        $userSet = true;
        $user = CurrentUser::getConfig();
    }   

?>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepTalk</title>
    <link rel="stylesheet" href="./styles/index.css" type="text/css">
    <script src="./jscript/main.js"></script>
    <link rel="icon" type="image/jpg" href="./resources/logo.png"/>
    <?php if ($_COOKIE["theme"] == "dark") { ?>
        <link rel="stylesheet" href="../styles/darkIndex.css">
    <?php } else if ($_COOKIE["theme"] == "light"){ ?>
        <link rel="stylesheet" href="../styles/lightIndex.css">
    <?php }?>
</head>

<body onload="enableDarkMode()">
    <video id="background-video" autoplay loop muted>
        <source src="resources/<?=$bgVid?>" type="video/mp4">
    </video>
    <img src="resources/<?=$wavesImage?>" id="wavesImage">

    <div id="contenedorImagen">
        <img src="resources/logo_completo.png" id="logoImage">
        <div id="logDiv">
            <?php if (!$userSet) { ?>
                <form>
                    <button formaction="./pages/signUp.php" id="signUpButton" value="Registrarse">Registrarse</button>
                    <button formaction="./pages/login.php" id="logInButton" value="Iniciar Sesion">Iniciar Sesion</button>
                </form>
            <?php } else { ?>
                <form>
                    <label id="userLabel"><?= $user["NombreUsuario"]?></label>
                    <button formaction="./pages/marco.php" id="logInButton" value="Iniciar Sesion">Mis chats</button>
                </form>
            <?php } ?>
        </div>
        <div class="contenedorMenu" onclick="mostrarMenu()">
            <div class="barra top"></div>
            <div class="barra middle"></div>
            <div class="barra bottom"></div>
        </div>
        <div id="menuOculto" class="oculto">
            <div id="logDivOculto">
                <form>
                    <button formaction="./pages/signUp.php" id="signUpButton" value="Registrarse">Registrarse</button>
                    <button formaction="./pages/login.php" id="logInButton" value="Iniciar Sesion">Iniciar Sesion</button>
                </form>
            </div>
        </div>
    </div>
    <div id="contenido">
        <h2 id="titBienvenida">¡Bienvenido/a a DeepTalk!</h2>
        <div id="Presentacion">
            <div class="contenedorPresentacion">
                <div>
                    <h2>Para aquellos que buscais una conversación de verdad</h2>
                    <p>Para ti, que estas leyendo esto y estas cansado de esas conversaciones monotonas y repetitivas, que buscas una conversación distinta.</p>
                </div>
                
                <img src="./resources/presentacion.jpg">
            </div>
            <div class="contenedorPresentacion">
                <img src="./resources/presentacion2.jpg">

                <div>
                    <h2>Os saludamos</h2>
                    <p>Somos DeepTalk y tenemos el orgullo de poder presentarnos a vosotros como LA página web en la que te guste lo que te guste siempre podras encontrar una conversación de tu interes.</p>
                </div>
            </div>
            <div class="contenedorPresentacion">
                <div>
                    <h2>¡Empecemos el viaje!</h2>
                    <p>Si has llegado hasta aqui no sabemos a que esperas, registrate y empecemos juntos este viaje por el espacio de diversión infinita, te esperamos dentro ;)</p>
                </div>
                
                <img src="./resources/presentacion3.jpg">
            </div>
        </div>
    </div>

</body>
</html>
