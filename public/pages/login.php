<?php

include("../../config/init.php");

$userData = [];
$user = "";
$passwd = "";

if (isset($_POST['usuario']) && $_POST['usuario'] != "" && isset($_POST['password']) && $_POST['password'] != "") {

    $user = $_POST['usuario']; 
    $passwd = $_POST['password'];

    $consultor = DbConector::singleton();
    $ok = $consultor->checkLogin($user, $passwd, $userData);

    if ($ok) {
        CurrentUser::setConfig($userData);
        header("Location: marco.php");
    }
}
?>


<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepTalk</title>
    <link rel="stylesheet" href="../styles/estilo.css" type="text/css">
    <link rel="icon" type="image/jpg" href="../resources/logo.png"/>
</head>

<body>
    <video id="background-video" autoplay loop muted>
        <source src="../resources/bg_3.mp4" type="video/mp4">
    </video>
    <form method="post">
        <div id="contenedor">
            <div id="contIzq">
                <img src="../resources/logo.png" id="logoPequeño">
                <img src="../resources/nombre.png" id="logoNombre">
            </div>
            <div id="contDcha">
                <div class="campos">
                    <input class="input" name="usuario" placeholder="Usuario" type="text">
                </div>
                <div class="campos">
                    <input class="input" name="password" placeholder="Contraseña" type="password">
                </div>
                <div id="campoBotones">
                    <input id="botonEnvio" type="submit" value="Acceder">
                    <button id="signUpButton" formaction="signUp.php">Crear cuenta</button>
                </div>
                <div id="campoOlvidada">
                    <a href="#" id="spanOlvidada">¿Has Olvidado la Contraseña?</a>
                </div>
            </div>
        </div>
    </form>
    <div id="cotenedorImagen">
        <a href="../index.php"><img src="../resources/logo_completo.png" id="logoImage"></a>
    </div>
</body>
</html>