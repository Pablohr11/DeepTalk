<?php 

    spl_autoload_register(function ($clase) {
        require("../storage/classes/".$clase."php");
    });

?>