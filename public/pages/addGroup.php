<?php
include("../../config/init.php");

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    die();
}

$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();

if (isset($_POST["enviar"]) && isset($_POST["groupName"])) {
    //if ($consultor->createGroupChat($user["ID_usuario"], $_POST["userName"])) {
    
    $gid;

    if ($consultor->createGroupChat( $_POST["groupName"], $user["ID_usuario"], $gid)) {
        $gname = $_POST["groupName"];
        $idUsuario = $user["ID_usuario"];
        $_SESSION["ngId"] = $gid;
        header("Location: addGroupStage2.php?gkey=$gid");
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