<?php 


class CurrentUser {
    
    public static $username;
    private static $mail;
    private static $tlf;

    // Hold an instance of the class
    private static $instance;

    // The singleton method
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            echo "hola";
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {}

    static function setConfig(array $userData) {
        session_start();
        $_SESSION["user"]=[$userData];
    }

    static function getConfig() {
        session_start();
        return $_SESSION["user"][0];
    }

    function __toString() {
        return $this->username ."asdasd ". $this->mail ." ". $this->tlf;
    }

}

?>


