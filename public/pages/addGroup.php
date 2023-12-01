<?php
include("../../config/init.php");


session_start();
$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();

if (isset($_POST["enviar"])) {
    //if ($consultor->createGroupChat($user["ID_usuario"], $_POST["userName"])) {
    if ($consultor->createGroupChat($_POST["groupName"], $_POST["firstUserName"], $_POST["secondUserName"], $user["ID_usuario"])) {
        echo '<script>parent.location.reload()</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/addPrivateChat.css">
</head>
<body>
    <form method="post" action="addGroup.php">
        <div id="container">
            <div id="image">
                <img src="../resources/gmImage.png" id="image">
            </div>
            <h3>Nuevo Grupo</h3>
            <p>Por favor, introduce el nombre del grupo</p>
            <div id="inputContainer">
                <div id="topDiv">
                    <label>Nombre</label>
                    <input type="text" class="inpu" name="groupName">
                </div>
                <input type="submit" name="enviar" id="enviar" value="Crear grupo">
            </div>
        </div>
    </form>
</body>
</html>