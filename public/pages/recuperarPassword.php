<?php

    require_once("../../config/init.php");
    require_once("../../storage/data.php");
    require_once("../../storage/classes/DbConector.php");
    define("TIPO_DE_TOKEN_VALIDO_EN_ESTA_PARTE", "Recuperacion");

    $user = CurrentUser::getConfig();
    $consultor = DbConector::singleton();
    $tokenProporcionado = null;

    //Esto de aqui lo hago para no tener que añadirle a la url que se envia por correo un campo que sea: ?token=muchoTexto.
    if(count($_GET)==1){
        foreach($_GET as $token => $vacio){
            $tokenProporcionado = $token;
        }
    }

    if($tokenProporcionado == null || strlen($tokenProporcionado)!= NUMERO_DE_CARACTERES_DE_UN_TOKEN){
        header("Location: ../index.php");
        die();
    }else{
        $arrayIdTipo = $consultor->consultarUnUsuarioTipoDeUnToken($tokenProporcionado);
        if($arrayIdTipo!= false && $arrayIdTipo!= null){
            $ID_usuario = $arrayIdTipo["ID_usuario"];
            $tipoToken = $arrayIdTipo["Tipo"];
            if($tipoToken !== TIPO_DE_TOKEN_VALIDO_EN_ESTA_PARTE){
                header("Location: ../index.php");
                die();
            }
        }else{
            header("Location: ../index.php");
            die();
        }
    }

    if((isset($_POST["recuperarContra"])) || (isset($_POST["password"]) && isset($_POST["repetirPassword"]) && trim($_POST["password"])!= "" && trim($_POST["repetirPassword"])!= "")){
        $error = "";
        if($_POST["password"] === $_POST["repetirPassword"]){
            $nuevaPass = $_POST["password"];
            $consultor->cambiarPasswordDeUsuario($nuevaPass, $ID_usuario);
            $consultor->eliminarUnToken($tokenProporcionado);
            header("Location: login.php");
            die();
        }else{ 
            $error = "Las contraseñas no coinciden.";
        }
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
    <script src="../jscript/recuperarPassword.js" defer></script>
</head>
<body>
    <div id="cuerpo">
        <div id="contenido">
            <video id="background-video" autoplay loop muted>
                <source src="../resources/<?=$bgVid?>" type="video/mp4">
            </video>

            <form action="" method="post" id="formularioCambio">
                <div id="contenedor">
                    <div id="contIzq">
                        <img src="../resources/logo.png" id="logoPequeño">
                        <img src="../resources/nombre.png" id="logoNombre">
                    </div>
                    <div id="contDcha">
                        <h2 class="tituloCont">Nueva Contraseña</h2>
                        
                        <div class="campos">
                            <input id="primeraPassword" class="input" name="password" placeholder="Introduzca su nueva contraseña." type="password">
                        </div>

                        <div class="campos">
                            <input id="segundaPassword" class="input" name="repetirPassword" placeholder="Introduzca de nuevo la contraseña." type="password">
                        </div>

                        <div id="campoBotones">
                            <input id="botonEnvio" type="submit" value="Cambiar Contraseña" name="recuperarContra">
                        </div>

                        <div id="errores">
                            <p id="textoError" class="info error"><?=$error?></p>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>
</html>