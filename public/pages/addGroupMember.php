<?php
include("../../config/init.php");

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    die();
}

$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();

if (isset($_GET["conversacion"])) {
    $_SESSION["gidToInvite"] = $_GET["conversacion"];
}
if (isset($_POST["enviar"]) && isset($_POST["user1"])) {
    $consultor->insertIntoGroup($_POST["user1"], $_SESSION["gidToInvite"]);
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
    <form method="post" action="addGroupMember.php">
        <div id="container">
            <div id="image">
                <img src="../resources/gmImage.png" id="image">
            </div>
            <h3>Invitar al grupo</h3>
            <p>Por favor, invita a un usuario</p>
            <div id="inputContainer">
                <div id="topDiv">
                    <label>Usuario</label>
                    <input type="text" class="inpu" name="user1">
                </div>
                <input type="submit" name="enviar" id="enviar" value="Invitar">
            </div>
        </div>
    </form>
</body>
</html>