<?php 


include("../../config/init.php");

$user = CurrentUser::getConfig();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepTalk</title>
    <link rel="stylesheet" href="../styles/perfil.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/jpg" href="../resources/logo.png"/>
</head>
<body>
    <div id="cuerpo">
        <div id="cabecera">
            <h3 class="subtitulo">Mi cuenta</h3>
            <a href="./marco.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="lightgray" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </a>
        </div>
        
        <div id="contendorCuenta">
            <div id="cuenta">
                <div id="preview">
                    <img id="imagenPerfil" src="../resources/usuarioDefault.png"/>
                    <div id="infoBasica">
                        <span class="nombreUsuario"><?php echo $user["NombreUsuario"]?></span>
                        <div id="logros">
                            <img class="trofeo" src="../resources/trofeoFundador.png" alt="trofeo">
                        </div>
                    </div>
                </div>

                <div id="datos">
                    <div class="contDato">
                        <div class="textoDato">
                            <span class="idDato">NOMBRE DE USUARIO</span>
                            <span class="dato"><?php echo $user["NombreUsuario"]?></span>
                        </div>
                        <button class="editarDato">Editar</button>
                    </div>

                    <div class="contDato">
                        <div class="textoDato">
                            <span class="idDato">ID DE USUARIO</span>
                            <span class="dato">#<?php echo $user["ID_usuario"]?></span>
                        </div>
                    </div>

                    <div class="contDato">
                        <div class="textoDato">
                            <span class="idDato">CORREO ELECTRONICO</span>
                            <span class="dato"><?php echo $user["Correo"]?></span>
                        </div>
                        <button class="editarDato">Editar</button>
                    </div>

                    <div class="contDato">
                        <div class="textoDato">
                            <span class="idDato">NÚMERO DE TELEFONO</span>
                            <span class="dato"><?php echo (isset($user["Telefono"]))?$user["Telefono"]:"No has introducido ningún telefono"?></span>
                        </div>
                        <button class="editarDato">Editar</button>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</body>
</html>