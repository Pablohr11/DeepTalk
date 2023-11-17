<?php
include("../../config/init.php");

$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();

$messages = $consultor->getMessages($_GET['conversacion']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/chat.css">
    <title>DeepTalk</title>
</head>
<body>
    <div id="cuerpo">
        <video id="background-video" autoplay loop muted>
            <source src="../resources/bg_3.mp4" type="video/mp4">
        </video>
        <div id="contenido">
            <div id="mensajes">
                <?php foreach ($messages as $key => $mensaje) { ?>
                    <div class="mensaje <?php echo ($mensaje[0] == $user["ID_usuario"])?"propio":"ajeno" ?>"><?php echo $mensaje[4]?></div>
                <?php } ?>
            </div>
            <div contentEditable=true placeholder="Enviar mensaje a //IntroducirNombreChat" id="cajaMensaje"></div>
        </div>
    </div>
</body>
</html>