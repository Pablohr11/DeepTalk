<?php
include("../../config/init.php");
require_once("../../storage/data.php");
define('TAMANO_MAX_IMG', 500000);
//

session_start();
$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();
$messages = $consultor->getMessages($_GET['conversacion']);
$otherUserName = $consultor->getUsernameFromChat($_GET['conversacion'], $user["ID_usuario"]);
$chatId = $_GET['conversacion'];
$lastMessage = $consultor->getLastMessageFromChat($chatId);

if (isset($_POST["mensajeEscrito"]) && $_POST["mensajeEscrito"] != "Enviar mensaje a $otherUserName" && trim($_POST["mensajeEscrito"]) != "") {
    if ($consultor->insertMessage($_GET['conversacion'], $user["ID_usuario"], $_POST["mensajeEscrito"], "texto")) {
        header("Location: chat.php?conversacion=$chatId");
        die();
    }
}

if (isset($_POST["recursoEnviado"])) {
    $subidaCorrecta = true;
    $archivo = DIRECTORIO_IMAGENES_MENSAJES . basename($_FILES["fileToUpload"]["recursoSubir"]);
    $tipoImagen = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
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
    <script src="../jscript/chat.js" defer></script>
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
                    <div class="mensaje <?=($mensaje[0] == $user["ID_usuario"]) ? "propio" : "ajeno" ?>">
                        <div class="remitente"><?= $consultor->getUsernameById($mensaje[0])?></div>
                        <pre class="contenedorTexto"><?php if($mensaje[5]==="texto"){ ?><p class="texto"><?=htmlspecialchars($mensaje[4])?></p><?php }else if($mensaje[5]==="imagen"){ ?><img class="imagen" src="<?=htmlspecialchars($mensaje[4])?>"><?php } ?></pre>
                    </div>
                <?php } ?>
            </div>
            
            <div id="contenedorBarraMensaje">
                <form id="formulario" method="post" action="chat.php?conversacion=<?=$_GET['conversacion'] ?>">
                    <textarea name="mensajeEscrito" placeholder="Enviar mensaje a <?=$otherUserName?>" id="cajaMensaje"></textarea>
                </form>
                <div id="enviarRecurso" class="contFuncionBarra recurso"><span class="funcionBarra">+</span></div>
                <div id="enviarMsg" class="contFuncionBarra enter"><img src="../resources/avion.png"></div>
            </div>

            <div id="pantallaRecurso" class="oculto">
                <div id="interfazRecurso">
                    <p id="cerrarRecurso">X</p>
                    <form action="" method="post">
                        <label for="seleccionRecurso">Seleccione la imagen que desea subir: </label>
                        <input type="file" name="recursoSubir" id="seleccionRecurso">
                        <br><input name="recursoEnviado" type="submit" value="¡Subir!">
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

</html>