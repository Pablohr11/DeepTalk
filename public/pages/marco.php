<?php 

include("../../config/init.php");

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    die();
}

$user = CurrentUser::getConfig();
$consultor = DbConector::singleton();
$userChats = $consultor->getUserChats($user["ID_usuario"]);
$userGroups = $consultor->getUserGroups($user["ID_usuario"]);
$userImage = ($consultor->getUserImage($user["ID_usuario"]));

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepTalk</title>
    <link rel="stylesheet" href="../styles/marco.css" type="text/css">
    <script src="../jscript/marco.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/jpg" href="../resources/logo.png"/>
    <?php if ($_COOKIE["theme"] == "dark") { ?>
        <link rel="stylesheet" href="../styles/darkMarco.css">
    <?php } else if ($_COOKIE["theme"] == "light"){ ?>
        <link rel="stylesheet" href="../styles/lightMarco.css">
    <?php }?>
</head>
<body>
    <div id="cuerpo">
        <header id="cabecera">
            <span id="flechaMostrarChats">←</span>
            <p id="nombreDeConversacion"></p>
        </header>

        <div id="contendedorLogo" class="visible">
            <a href="../index.php"><img id="logo" src="../resources/logo_completo.png" alt="logo"/></a>
        </div>

        <div id="barraLateral" class="visible">
            <ul>
                <li onclick="desplegar(0)">Mensajes</li>
                <div class="oculto">
                    <?php if(empty($userChats)){ ?>
                        <span class="menuVacio">Aqui no hay nada :(</span>
                    <?php }else{ ?>
                        <?php foreach ($userChats as $key=>$userChat) { 
                            $userChatId = ($consultor->getUserIdFromName($consultor->getUsernameFromChat($userChat[0],$user["ID_usuario"]))); ?>
                            <a class="marcoButton" target="iframe" href="chat.php?conversacion=<?= $userChat[0]?>">
                                <button class="Button" formaction="" value="<?=$key?>">
                                    <img class="imagenPerfil" src="<?php echo $consultor->getUserImage($userChatId) ?>">
                                    <span class="nombreUsuario"><?php echo $consultor->getUsernameFromChat($userChat[0],$user["ID_usuario"]) ?></span>
                                </button>
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <div class="addDivButton">
                        <a target="iframe" href="./addPrivateChat.php"><button class="addNew" >+</button></a>
                    </div>
                </div>
                <li onclick="desplegar(2)">Grupos</li>
                <div class="oculto">
                    <?php if(empty($userGroups)){ ?>
                        <span class="menuVacio">Aqui no hay nada :(</span>
                    <?php }else{ ?>
                        <?php foreach ($userGroups as $userGroup) {?>
                            <a class="marcoButton" target="iframe" href="chatGrupal.php?conversacion=<?= $userGroup[0]?>"><button class="Button" formaction="" value="<?=$key?>"><?= $userGroup[1] ?></button></a>
                        <?php } ?>
                    <?php } ?>
                    <div class="addDivButton">
                        <a target="iframe" href="./addGroup.php"><button class="addNew" >+</button></a>
                    </div>
                </div>
                <li style="appearence: none" onclick="desplegar(4)">Hilos</li>
                <div class="oculto"><p>Implementar los chats</p></div>
                <!--<li onclick="desplegar(3)">Recomendados</li>
                <div class="oculto"><p>Implementar los chats</p></div>!-->

                <span id="flechaOcultarChats">←</span>
            </ul>
        </div>

        <div id="contenido">
            <video id="background-video" autoplay loop muted>
                <source src="../resources/<?=$bgVid?>" type="video/mp4">
            </video>
            <iframe name="iframe" ></iframe>
        </div>

        <div id="perfil" class="visibleFlex">
            <!--TODO: Implemnetar que esta imagen cambie segun el perfil.-->
            <img id="usuario" src="<?=$userImage?>" alt="Imagen usuario">
            <div id="contendedorInfo">
                <!--TODO: Implemnetar que estos tesxtos cambien segun el perfil.-->
                <p id="nombre"><?php echo $user["NombreUsuario"]?></p>
                <span id="id">#<?php echo $user["ID_usuario"]?></span>
            </div>
            <a href="./perfil.php">
                <svg id="engranaje" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                </svg>
            </a>
        </div>
    </div>
</body>
</html>
