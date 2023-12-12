<?php 
    session_start();
    include("themes.php");
    spl_autoload_register(function ($clase) {
        require_once("../../storage/classes/".$clase.".php");
    });

?>