<?php 


class CurrentUser {
    
    public $username;
    private $mail;
    private $tlf;

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

    private function __construct() {

    }
    public function setConfig(string $username, string $mail, int $tlf = 0) {
        $this->username = $username;
        $this->mail = $mail;
        $this->tlf = $tlf;

        echo "aaaa".$this->username;
    }

    function getUsername() {
        return $this->username;
    }

    function getMail(): string {
        return $this->mail;
    }

    function getTlf(): int {
        return $this->tlf;
    }


    function setUsername(string $username) {
        $this->username = $username;
    }

    function setMail(string $mail) {
        $this->mail = $mail;
    }

    function setTlf(int $tlf) {
        $this->tlf = $tlf;
    }


    function __toString() {
        return $this->username ."asdasd ". $this->mail ." ". $this->tlf;
    }

}

?>


