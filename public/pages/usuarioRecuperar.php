<?php

    require_once("../../config/init.php");
    require_once("../../storage/data.php");
    require_once("../../storage/classes/DbConector.php");
    define("RUTA_ARCHIVO_PARA_CAMBIAR_PASSWORD", "http://localhost:8000/public/pages/recuperarPassword.php");

    $user = CurrentUser::getConfig();
    $consultor = DbConector::singleton();

    if(isset($_POST["recuperarContra"])){
        $usuarioRecuperar = $_POST["usuario"];
        $IdUsuarioRecuperar = $consultor->getUserIdFromName($usuarioRecuperar);
        if($IdUsuarioRecuperar!== false && $IdUsuarioRecuperar!== null){
            $tipoToken = "Recuperacion";
            $consultor->crearUnTipoDeTokenParaUnUsuario($IdUsuarioRecuperar, $tipoToken);
            $tokenDeRecuperacion = $consultor->consultarTokenDeUnUsuarioPorTipo($IdUsuarioRecuperar, $tipoToken);
            $rutaDeRecuperacion = RUTA_ARCHIVO_PARA_CAMBIAR_PASSWORD ."?$tokenDeRecuperacion";
            $correoDeRecuperacion = $consultor->obtenerMailDeUsuario($usuarioRecuperar);
            sendMail($correoDeRecuperacion, $usuarioRecuperar, "Recuperar Password" ,"Buenas, usted esta tratando de cambiar la contraseña para el usuario $usuarioRecuperar, si es así, visite el siguiente enlace: <a href='$rutaDeRecuperacion'>$rutaDeRecuperacion</a>.<br>En caso de que usted no haya solicitado esta acción, por favor ponganse en contacto lo antes posible con el soporte de DeepTalk.<br> ¡Un saludo!");
        }
        header("Location: usuarioRecuperar.php");
        die();
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepTalk</title>
    <link rel="stylesheet" href="../styles/estilo.css" type="text/css">
    <link rel="icon" type="image/jpg" href="../resources/logo.png"/>
</head>
<body>
    <div id="cuerpo">
        <div id="contenido">
            <video id="background-video" autoplay loop muted>
                <source src="../resources/<?=$bgVid?>" type="video/mp4">
            </video>

            <form action="" method="post">
                <div id="contenedor">
                    <div id="contIzq">
                        <img src="../resources/logo.png" id="logoPequeño">
                        <img src="../resources/nombre.png" id="logoNombre">
                    </div>
                    <div id="contDcha">
                        <h2 class="tituloCont">Recuperar Contraseña</h2>
                        
                        <div class="campos">
                            <input class="input" name="usuario" placeholder="Introduzca el usuario a recuperar." type="text">
                        </div>

                        <div id="campoBotones">
                            <input id="botonEnvio" type="submit" value="Mandar Correo" name="recuperarContra">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>
</html>