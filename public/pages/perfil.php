<?php 
include("../../config/init.php");
require_once("../../storage/data.php");
define("TAMANO_MAX_IMG", 5000000);
define("DIRECTORIO_IMAGENES_PERFIL", "../resources/perfiles/");
define("DIRECTORIO_IMAGENES_LOGROS", "../resources/logros/");


$consultor = DbConector::singleton();
comprobarSiTieneSesion();
/*
    La variable $perfilPropio la emplearemos para saber si el perfil que se esta
    cargando es es el perfil propio del usuario o si por el contrario esta 
    visitando el perfil de otro usuario.
*/
$perfilPropio = !isset($_GET["usuarioPropietario"]);
$user = (($perfilPropio)?CurrentUser::getConfig():$consultor->obtenerObjetoUsuarioDeNombreUsuario($_GET["usuarioPropietario"]));
if($user==false || $user == null || $user==0){
    header("Location: marco.php");
    die();
}
$userImage = ($consultor->getUserImage($user["ID_usuario"]));
$logrosDelUsuario = ($consultor->getUserAchievements($user["ID_usuario"]));

if (isset($_POST["closeSession"])) {
    session_unset();
    if(isset($_COOKIE["Recuerdame"])){
        $consultor->eliminarUnToken($_COOKIE["Recuerdame"]);
        setcookie("Recuerdame", "", (time() - 1));
    }
    header("Location: ../index.php");
    die();
}

if (isset($_POST["recursoEnviado"]) && isset($_FILES["recursoSubir"]) && !($_FILES["recursoSubir"]["name"]=="")){

    $nombreArchivo = basename($_FILES["recursoSubir"]["name"]);
    $archivo = DIRECTORIO_IMAGENES_PERFIL . $nombreArchivo;
    $formatoImagen = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    $tamanoImagen = (($_FILES["recursoSubir"]["error"]!=0)?false:getimagesize($_FILES["recursoSubir"]["tmp_name"]));
    $archivo = DIRECTORIO_IMAGENES_PERFIL . $user["NombreUsuario"] .'.'. $formatoImagen;
    $nombreArchivo = $user["NombreUsuario"] .'.'. $formatoImagen;

    if($tamanoImagen !== false){
        $subidaCorrecta = true;
    }else{
        $subidaCorrecta = false;
    }

    if ($_FILES["recursoSubir"]["size"] > TAMANO_MAX_IMG) {
        $subidaCorrecta = false;
    }

    if($formatoImagen != "jpg" && $formatoImagen != "png" && $formatoImagen != "jpeg" && $formatoImagen != "gif" ){
        $subidaCorrecta = false;
    }
    
    if ($subidaCorrecta) {
        if (move_uploaded_file($_FILES["recursoSubir"]["tmp_name"], $archivo)) {

            if($userImage != DIRECTORIO_IMAGENES_PERFIL . "usuarioDefault.png" && $userImage!=$archivo){
                unlink($userImage);
            }

            $consultor->actualizarRutaFotoPerfil($user["ID_usuario"], $archivo);
            header("Location: perfil.php");
            die();
        } else {
            echo "Hubo un error al subir tu archivo: ". $_FILES["recursoSubir"]["tmp_name"]. $archivo;
        }
    }else{
        echo "Hubo un error al procesar su imagen pruebe de nuevo o trate con otra imagen.";
    }
    
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepTalk</title>
    <link rel="stylesheet" href="../styles/perfil.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/jpg" href="../resources/logo.png"/>
    <script src="../jscript/perfil.js" defer></script>
    <?php if ($_COOKIE["theme"] == "dark") { ?>
        <link rel="stylesheet" href="../styles/darkPerfil.css">
    <?php } else if ($_COOKIE["theme"] == "light"){ ?>
        <link rel="stylesheet" href="../styles/lightPerfil.css">
    <?php }?>
</head>
<body>
    <div id="cuerpo">
        <div id="cabecera">
            <h3 class="subtitulo">Mi cuenta</h3>
            <a href="./marco.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="lightgray" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </a>
        </div>
        
        <div id="contendorCuenta">
            <div id="cuenta">
                <div id="preview">
                    <div id="contenedorImagenPerfil">
                        <img id="imagenPerfil" src="<?=$userImage?>"/>
                        <?php if($perfilPropio){ ?>
                        <div id="editarImg" class="oculto"><span>&#9998;</span></div>
                        <?php } ?>
                    </div>
                    <div id="infoBasica">
                        <span class="nombreUsuario"><?php echo $user["NombreUsuario"]?></span>
                        <div id="logros">
                            <?php foreach($logrosDelUsuario as $objetoLogro){ ?>
                            <img class="trofeo" src="<?=DIRECTORIO_IMAGENES_LOGROS.$objetoLogro["NombreDeImagenAsociada"]?>" alt="trofeo">
                            <div class="contenedorInfoTrofeo">
                                <p><span class="tituloDelTrofeo"><?=$objetoLogro["NombreLogro"]?></span> [<?=$objetoLogro["FechaConseguido"]?>]</p>
                                <p><?=$objetoLogro["Descripcion"]?></p>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if($perfilPropio){ ?>
                        <form>
                            <button id="themeButton" formaction="./themePicker.php">Elegir Tema</button>
                        </form>
                        <?php } ?>
                    </div>
                </div>

                <div id="datos">
                    <div class="contDato">
                        <div class="textoDato">
                            <span class="idDato">NOMBRE DE USUARIO</span>
                            <span class="dato"><?php echo $user["NombreUsuario"]?>#<?php echo $user["ID_usuario"]?></span>
                        </div>
                    </div>

                    <div class="contDato">
                        <div class="textoDato">
                            <span class="idDato">CORREO ELECTRONICO</span>
                            <span class="dato"><?php echo $user["Correo"]?></span>
                        </div>
                    </div>

                    <div class="contDato">
                        <div class="textoDato">
                            <span class="idDato">NÚMERO DE TELEFONO</span>
                            <span class="dato"><?php echo (isset($user["Telefono"]))?$user["Telefono"]:"No has introducido ningún telefono"?></span>
                        </div>
                    </div>
                    <?php if($perfilPropio){ ?>
                    <div class="contDato ultimo">
                        <form method="post" action="./perfil.php">
                            <button id="closeButton" name="closeSession">Cerrar Sesión</button>
                        </form>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div id="pantallaRecurso" class="oculto">
            <div id="interfazRecurso">
                <p id="cerrarRecurso">X</p>
                <form enctype="multipart/form-data" action="./perfil.php" method="post">
                    <label for="seleccionRecurso">Seleccione la imagen que desea subir: </label>
                    <br><input type="file" name="recursoSubir" id="seleccionRecurso">
                    <br><span class="recordatorio">Solo se aceptaran archivos de tipo : .jpg, .png, .jpeg y .gif</span>
                    <br><input name="recursoEnviado" type="submit" value="¡Subir!">
                </form>
            </div>
        </div>

    </div>
</body>
</html>
