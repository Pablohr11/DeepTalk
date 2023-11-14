<?php 


class DbConector {
    
    private const DB_DATA = "mysql:host=localhost;dbname=deeptalk";
    private const USERNAME = "pablohr11" ;
    private const PASSWD = "";
    private $db = "";

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
        $this->db = new PDO($this::DB_DATA, $this::USERNAME, $this::PASSWD);
    }

    public function checkLogin($user, $passwd) {
        try {
            $consulta = $this->db->prepare("select NombreUsuario, Contraseña from Usuario where NombreUsuario = :username and Contraseña = :passwd");
            
            $consulta->bindParam(":username", $user, PDO::PARAM_STR);
            $consulta->bindParam(":passwd", $passwd, PDO::PARAM_STR);
    
            $results = $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
    
    //        foreach ($data as $usuario) {
            echo "Usuario ".$data["NombreUsuario"]." Contraseñas ".$data["Contraseña"];
            if ($data["NombreUsuario"] == $user && $data["Contraseña"] == $passwd) {
                return true;
            }
      //      }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function insertUser($user, $passwd, $mail):bool {
        try {
            $consulta = $this->db->prepare("insert into Usuario (NombreUsuario, Contraseña, Correo) values (:username, :passwd, :mail)");
            
            $consulta->bindParam(":username", $user, PDO::PARAM_STR);
            $consulta->bindParam(":passwd", $passwd, PDO::PARAM_STR);
            $consulta->bindParam(":mail", $mail, PDO::PARAM_STR);

            $results = $consulta->execute();

            if ($results) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
}



?>