<?php 


class CurrentUser {
    
    private $username;
    private $mail;
    private $tlf;
    private $valoracion;

    // Hold an instance of the class
    private static $instance;

    // The singleton method
    public static function singleton(string $username, string $mail, int $tlf = 0, int $valoracion = -1)
    {
        if (!isset(self::$instance)) {
            
            self::$instance = new self($username, $mail, $tlf = 0,$valoracion = -1);
        }
        return self::$instance;
    }
    private function __construct(string $username, string $mail, int $tlf = null, int $valoracion = null) {
        $this->setUsername($username);
        $this->setMail($mail);
        $this->setTlf($tlf);
        $this->setValoracion($valoracion);
    }

    function getUsername(): string {
        return $this->username;
    }

    function getMail(): string {
        return $this->mail;
    }

    function getTlf(): int {
        return $this->tlf;
    }

    function getValoracion(): int {
        return $this->valoracion;
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

    function setValoracion(int $valoracion) {
        $this->valoracion = $valoracion;
    }

    function __toString() {
        return $this->getUsername() ." ". $this->getMail() ." ". $this->getTlf() ." ". $this->getValoracion();
    }

}

$usu = CurrentUser::singleton("pablo", "pabloherederoreyes@gmail.com");
echo $usu . "<br>";


$usu = CurrentUser::singleton("pedro", "juan@gmail.com");
echo $usu;
?>


