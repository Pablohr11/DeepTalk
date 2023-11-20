<?php

include("../../storage/data.php");
include("../../storage/classes/DbConector.php");
include("../../storage/classes/FormChecker.php");

$errores;
if (isset($_POST["envio"])) {
    $user = $_POST["user"];
    $mail = $_POST["email"];
    $passwd = $_POST["passwd"];

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
                    <input class="input" name="email" placeholder="Email" type="text">
                </div>
                <div class="campos">
                    <input class="input" name="user" placeholder="Usuario" type="text">
                </div>
                <div class="campos">
                    <input class="input" name="passwd" placeholder="Contraseña" type="password">
                </div>
                <div id="campoBotones">
                    <button id="signUpButton" name="envio" value="envio">Crear cuenta</button>
                    <button id="botonEnvio" formaction="login.php">Iniciar Sesion</button>
                </div>
                <div id="errores">
                    <?php echo (isset($errores["user"])?"<p class='info error'>El usuario no es válido</p>":"")  ?>
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