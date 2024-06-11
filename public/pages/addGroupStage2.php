<?php
include("../../config/init.php");

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    die();
}
$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();

$gid = $_SESSION["ngId"];
if (isset($_POST["enviar"]) && isset($_POST["user1"]) && isset($_POST["user2"])) {
    $consultor->insertIntoGroup($user["NombreUsuario"], $gid);
    $consultor->insertIntoGroup($_POST["user1"], $gid);
    $consultor->insertIntoGroup($_POST["user2"], $gid);
    echo '<script>parent.location.reload()</script>';
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
    <form method="post" action="addGroupStage2.php">
        <div id="container">
            <div id="image">
                <img src="../resources/gmImage.png" id="image">
            </div>
            <h3>Nuevo Grupo</h3>
            <p>Por favor, invita al menos a dos usuarios al grupo</p>
            <div id="inputContainer">
                <div id="topDiv">
                    <label>Usuario 1</label>
                    <input type="text" class="inpu" name="user1">
                </div>
                <div id="botDiv">
                    <label>Usuario 2</label>
                    <input type="text" class="inpu" name="user2">
                </div>
                <input type="submit" name="enviar" id="enviar" value="Invitar">
            </div>
        </div>
    </form>
</body>
</html>