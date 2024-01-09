<?php

require_once("../../storage/data.php");
require_once("../../storage/classes/DbConector.php");
require_once("../../storage/classes/FormChecker.php");

if (isset($_POST["envio"])) {
    $user = $_POST["user"];
    $mail = $_POST["email"];
    $passwd = $_POST["passwd"];
    $errores = [];

    $validForm = checkSignUpForm($user, $mail, $passwd, $errores);

    if ($validForm) {
        $consultor = DbConector::singleton();
        $insert = $consultor->insertUser($user, $passwd, $mail);
        if( $insert ) {
            sendMail($mail, $user, "Te has registrado en Deeptalk", "El usuario $user se ha registrado correctamente en nuestro servicio ¡Un saludo!");
            header("Location: login.php?user=$user");
        }
    }
}
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepTalk</title>
    <link rel="stylesheet" href="../styles/estilo.css" type="text/css">
    <link rel="stylesheet" href="../styles/signUp.css" type="text/css">
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
                    <input class="input" name="email" placeholder="Email" type="text" value="<?=((isset($mail))?$mail:"")?>">
                </div>
                <div class="campos">
                    <input class="input" name="user" placeholder="Usuario" type="text" value="<?=((isset($user))?$user:"")?>">
                </div>
                <div class="campos">
                    <input class="input" name="passwd" placeholder="Contraseña" type="password" value="<?=((isset($passwd))?$passwd:"")?>">
                </div>
                <div id="campoBotones">
                    <button id="signUpButton" name="envio" value="envio">Crear cuenta</button>
                    <button id="botonEnvio" formaction="login.php">Iniciar Sesion</button>
                </div>
                <div id="errores">
                    <?php if(isset($errores["usuario"])){ ?>
                        <p class="info error"><?=$errores["usuario"]?></p>
                    <?php }else if(isset($errores["mail"])){ ?>
                        <p class="info error"><?=$errores["mail"]?></p>
                    <?php }else if(isset($errores["contrasena"])){ ?>
                        <p class="info error"><?=$errores["contrasena"]?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- <div id="contenedorSignUp">
            <span>¿No tienes una cuenta?</span>
            <button id="signUpButton" formaction="signUp.html">Crea una cuenta</button>
        </div> -->
    </form>
    <div id="cotenedorImagen">
        <a href="../index.php"><img src="../resources/logo_completo.png" id="logoImage"></a>
    </div>
</body>
</html>