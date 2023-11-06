<?php 


class DbConector {
    
    private const DB_DATA = "mysql:host=localhost;dbname=Deeptalk";
    private const USERNAME = "pablohr11" ;
    private const PASSWD = "";

    // Hold an instance of the class
    private static $instance;

    // The singleton method
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function __construct() {
        echo "creao";
        $db = new PDO($this::DB_DATA, $this::USERNAME, $this::PASSWD);
    }


}

$usu = DbConector::singleton();
?>