<?php

    include("../../config/init.php");

    if (isset($_GET["clasico"])) {
        setcookie("theme", "classic", time()+60*60,"/");
        header("Location: marco.php");
        die();
    } else if (isset($_GET["oscuro"])) {
        setcookie("theme", "dark", time()+60*60,"/");
        header("Location: marco.php");
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/themePicker.css">
</head>
<body>
    <video id="background-video" autoplay loop muted>
        <source src="../resources/<?=$bgVid?>" type="video/mp4">
    </video>
    <div id="cotenedorImagen">
        <a href="../index.php"><img src="../resources/logo_completo.png" id="logoImage"></a>
    </div>
    <div id="contenedorPrincipal">
        <form action="themePicker.php" method="get">
            <div id="claro">
                <h2>MODO CLARO</h2>
                <video class="show-video" autoplay loop muted>
                    <source src="../resources/<?=$bgVid?>" type="video/mp4">
                </video>
                <input class="botonSeleccion" value="SELECCIONAR" type="submit" name="claro">
            </div>
            <div id="clasico">
                <h2>MODO CLÁSICO</h2>
                <video class="show-video" autoplay loop muted>
                    <source src="../resources/bg_3.mp4" type="video/mp4">
                </video>
                <input class="botonSeleccion" value="SELECCIONAR" type="submit" name="clasico">
            </div>
            <div id="oscuro">
                <h2>MODO OSCURO</h2>
                <video class="show-video" autoplay loop muted>
                    <source src="../resources/bg_2.mp4" type="video/mp4">
                </video>
                <input class="botonSeleccion" value="SELECCIONAR" type="submit" name="oscuro">
            </div>
        </form>
    </div>
</body>
</html>