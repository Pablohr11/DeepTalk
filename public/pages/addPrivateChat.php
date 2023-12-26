<?php
include("../../config/init.php");

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    die();
}

$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();

if (isset($_POST["enviar"])) {
    if ($consultor->createPrivateChat($user["ID_usuario"], $_POST["userName"])) {
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../jscript/addUsers.js"></script>
</head>
<body onload="init()">
    <form method="post" action="addPrivateChat.php">
        <div id="container">
            <div id="image">
                <img src="../resources/pmImage.png" id="image">
            </div>
            <h3>Nueva conversacion privada</h3>
            <p>Por favor, introduce el nombre de otro usuario para crear la conversación</p>
            <div id="botDiv">
                <span class="myarrow"><input id="inpu" name="userName" list="selector"></span>
                <datalist id="selector">
                </datalist>
                <input type="submit" name="enviar" id="enviar" value="+">
            </div>
        </div>
    </form>
</body>
</html>