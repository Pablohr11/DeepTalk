<?php 
    session_start();
    spl_autoload_register(function ($clase) {
        require_once("../../storage/classes/".$clase.".php");
    });

?>