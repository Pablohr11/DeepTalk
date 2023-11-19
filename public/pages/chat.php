<?php
include("../../config/init.php");


session_start();
$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();
$messages = $consultor->getMessages($_GET['conversacion']);
$otherUserName = $consultor->getUsernameFromChat($_GET['conversacion'], $user["ID_usuario"]);
$chatId = $_GET['conversacion'];

if (isset($_POST["mensajeEscrito"]) && $_POST["mensajeEscrito"] != "Enviar mensaje a $otherUserName") {
    if ($consultor->insertMessage($_GET['conversacion'], $user["ID_usuario"], $_POST["mensajeEscrito"])) {
        header("Location: chat.php?conversacion=$chatId");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/chat.css">
    <title>DeepTalk</title>
    <script src="../jscript/chat.js"></script>
</head>
<body onload="init()">
    <div id="cuerpo">
        <video id="background-video" autoplay loop muted>
            <source src="../resources/bg_3.mp4" type="video/mp4">
        </video>
        <div id="contenido">
            <div id="mensajes">
                <?php foreach ($messages as $key => $mensaje) { ?>
                    <div class="mensaje <?php echo ($mensaje[0] == $user["ID_usuario"])?"propio":"ajeno" ?>">
                        <div class="remitente"><?php echo $consultor->getUsernameById($mensaje[0])?></div>
                        <label class="texto"><?php echo $mensaje[4]?></label>
                    </div>
                <?php } ?>
            </div>
            <div contentEditable=true placeholder="Enviar mensaje a <?php echo $otherUserName?>" id="cajaMensaje"></div>
            <form id="formulario" method="post" action="chat.php?conversacion=<?php echo $_GET['conversacion']?>">
                <input type="text" name="mensajeEscrito" id="mensajeEscrito">
            </form>
        </div>
    </div>
</body>
</html>