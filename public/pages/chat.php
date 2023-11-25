<?php
include("../../config/init.php");


session_start();
$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();
$messages = $consultor->getMessages($_GET['conversacion']);
$otherUserName = $consultor->getUsernameFromChat($_GET['conversacion'], $user["ID_usuario"]);
$chatId = $_GET['conversacion'];
$lastMessage = $consultor->getLastMessageFromChat($chatId);


if (isset($_POST["mensajeEscrito"]) && $_POST["mensajeEscrito"] != "Enviar mensaje a $otherUserName" && trim($_POST["mensajeEscrito"]) != "") {
    if ($consultor->insertMessage($_GET['conversacion'], $user["ID_usuario"], $_POST["mensajeEscrito"])) {
        header("Location: chat.php?conversacion=$chatId");
        die();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../jscript/chat.js"></script>
    <script>
        var ultimoMensaje = <?php echo $lastMessage?>;
        function obtenerLosNuevos() {
            $.ajax({
                url: 'ajax.php',
                method: 'GET',
                data: {
                    idChat: <?= $_GET['conversacion']?>,
                    ultimoMensaje: ultimoMensaje
                },
                dataType: 'json',
                success: function(mensajesFaltantes) {
                    for (var mensaje of mensajesFaltantes) {
                        
                        showMessage(mensaje, "<?= $otherUserName?>", <?php echo $user["ID_usuario"]?>);
                        ultimoMensaje = mensaje[1];
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
        setInterval(obtenerLosNuevos, 1000);
    </script>
</head>

<body onload="init()">
    <div id="cuerpo">

        <div id="contenido">
            <div id="mensajes">
                <?php foreach ($messages as $key => $mensaje) { ?>
                    <div class="mensaje <?php echo ($mensaje[0] == $user["ID_usuario"]) ? "propio" : "ajeno" ?>">
                        <div class="remitente"><?php echo $consultor->getUsernameById($mensaje[0]) ?></div>
                        <label class="texto"><?php echo $mensaje[4] ?></label>
                    </div>
                <?php } ?>
            </div>
            
            <div id="contenedorBarraMensaje">
                <div contentEditable=true placeholder="Enviar mensaje a <?=$otherUserName?>" id="cajaMensaje"></div>
                <div class="contFuncionBarra recurso"><span class="funcionBarra">+</span></div>
                <div id="enviarMsg" class="contFuncionBarra enter"><img src="../resources/avion.png"></div>
                <form id="formulario" method="post" action="chat.php?conversacion=<?=$_GET['conversacion'] ?>">
                    <textarea name="mensajeEscrito" id="mensajeEscrito"></textarea>
                    <input type="text" id="varDePaso">
                </form>
            </div>
        </div>
    </div>
</body>

</html>