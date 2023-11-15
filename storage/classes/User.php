<?php

class User {
    private $userName;
    private $mail;
    private $tlf;

    function __construct($userName, $mail, $tlf) {
        $this->userName = $userName;
        $this->mail = $mail;
        $this->tlf = $tlf;
    }
}  

?>