<?php

include("../../config/init.php");
include("../../storage/classes/DbConector.php");
require_once("../../storage/data.php");
include("../../storage/classes/FormChecker.php");
define("TIPO_DE_TOKEN_VALIDO_EN_ESTA_PARTE", "Recuerdame");
//En segundos
define("TIEMPO_DE_AMPLIACION", 604800);
$consultor = DbConector::singleton();

$paginaRedireccion = ((isset($_COOKIE["paginaRedireccion"]))?$_COOKIE["paginaRedireccion"]:"./marco.php");

if(isset($_COOKIE["Recuerdame"]) && $_COOKIE["Recuerdame"] !== null && strlen($_COOKIE["Recuerdame"]) == NUMERO_DE_CARACTERES_DE_UN_TOKEN){
    $tokenProporcionado = $_COOKIE["Recuerdame"];
    $arrayIdTipo = $consultor->consultarUnUsuarioTipoDeUnToken($tokenProporcionado);
    //este if basicamente dice, si hay una fila en la tabla Tokens de la base de datos, que tenga ese token, hacer lo siguiente:
    if($arrayIdTipo!= false && $arrayIdTipo!= null){
        //ID del propietario de ese token
        $ID_usuario = $arrayIdTipo["ID_usuario"];
        //Tipo del token proporcionado.
        $tipoToken = $arrayIdTipo["Tipo"];
        if($tipoToken === TIPO_DE_TOKEN_VALIDO_EN_ESTA_PARTE){
            $datosUsuario = $consultor->obtenerDatosDeUnUsuarioPorSuId($ID_usuario);
            CurrentUser::setConfig($datosUsuario);
            header("Location: ". $paginaRedireccion);
            setcookie("paginaRedireccion", "", (time() - 1));
            die();
        }
    }
}


if(isset($_GET["user"])){
    $user = $_GET["user"];
}else{
    $user = "";
}

$userData = [];
$passwd = "";

if(isset($_POST['acceder'])){
    $user = $_POST["usuario"];
    $passwd = $_POST["password"];
    $mantener = ((isset($_POST["mantener"]) && $_POST["mantener"]==true)?true:false);
    $errores = [];

    $formularioValido = checkSignInForm($user, $passwd, $errores);

    if($formularioValido){
        $ok = $consultor->checkLogin($user, $passwd, $userData);

        if ($ok) {
            if($mantener){
                $IdUsuarioMantener = $consultor->getUserIdFromName($user);
                $consultor->crearUnTipoDeTokenParaUnUsuario($IdUsuarioMantener, TIPO_DE_TOKEN_VALIDO_EN_ESTA_PARTE);
                $tokenParaMantener = $consultor->consultarTokenDeUnUsuarioPorTipo($IdUsuarioMantener, TIPO_DE_TOKEN_VALIDO_EN_ESTA_PARTE);
                setcookie("Recuerdame", $tokenParaMantener, (time() + TIEMPO_DE_AMPLIACION));
            }
            CurrentUser::setConfig($userData);
            header("Location: ". $paginaRedireccion);
            setcookie("paginaRedireccion", "", (time() - 1));
            die();
        } else {
            $errores["usuario"] = "Las credenciales no son correctas.";
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
                    <input class="input" name="usuario" placeholder="Usuario" type="text" value="<?=$user?>">
                </div>
                <div class="campos">
                    <input class="input" name="password" placeholder="Contraseña" type="password" value="<?=$passwd?>">
                </div>
                <div class="campos">
                    <label class="labelMantener" for="mantenermeIniciado">Mantenerme Iniciado</label>
                    <input id="mantenermeIniciado" name="mantener" type="checkbox" value="true" <?=(($mantener)?"checked":"")?>>
                </div>
                <div id="campoBotones">
                    <input id="botonEnvio" type="submit" value="Acceder" name="acceder">
                    <button id="signUpButton" formaction="signUp.php">Crear cuenta</button>
                </div>
                <div id="campoOlvidada">
                    <a href="./usuarioRecuperar.php" id="spanOlvidada">¿Has Olvidado la Contraseña?</a>
                </div>
                <div id="errores">
                    <?php if(isset($errores["usuario"])){ ?>
                        <p class="info error"><?=$errores["usuario"]?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </form>
    <div id="cotenedorImagen">
        <a href="../index.php"><img src="../resources/logo_completo.png" id="logoImage"></a>
    </div>
</body>
</html>