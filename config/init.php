<?php 
    session_start();
    include("themes.php");
    include("../storage/data.php");
    spl_autoload_register(function ($clase) {
        require_once("../../storage/classes/".$clase.".php");
    });

?>