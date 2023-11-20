<?php 


class DbConector {
    
    private const DB_DATA = "mysql:host=localhost;dbname=Deeptalk";
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

    public function checkLogin($user, $passwd, &$userData) {
        try {
            $consulta = $this->db->prepare("select ID_usuario, NombreUsuario, Contraseña, Correo, Telefono from Usuario where NombreUsuario = :username and Contraseña = :passwd");
            
            $consulta->bindParam(":username", $user, PDO::PARAM_STR);
            $consulta->bindParam(":passwd", $passwd, PDO::PARAM_STR);
    
            $results = $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
    
    //        foreach ($data as $usuario) {
            
            if ($data["NombreUsuario"] == $user && $data["Contraseña"] == $passwd) {
                $userData = $data;
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
            $consulta = $this->db->prepare("insert into Usuario (NombreUsuario, Contraseña, Correo, Tipo) values (:username, :passwd, :mail, 'base')");
            
            $consulta->bindParam(":username", $user, PDO::PARAM_STR);
            $consulta->bindParam(":passwd", $passwd, PDO::PARAM_STR);
            $consulta->bindParam(":mail", $mail, PDO::PARAM_STR);

            $results = $consulta->execute();

            
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function getUserChats($id) {
        $consulta = $this->db->prepare("select ID_conversacion from Conversacion, Usuario where (Conversacion.ID_usuario1 = Usuario.ID_usuario or
        Conversacion.ID_usuario2 = Usuario.ID_usuario) and Usuario.ID_usuario = :id_usuario");
            
        $consulta->bindParam(":id_usuario", $id, PDO::PARAM_STR);

        $results = $consulta->execute();
        $data = $consulta->fetchAll(PDO::FETCH_NUM);

        return $data;
    }

    public function getUsernameFromChat($chatId, $currentUserId) {
        $consulta = $this->db->prepare("select NombreUsuario from Conversacion, Usuario where (Conversacion.ID_conversacion = :id_chat) and 
        (Usuario.ID_usuario = Conversacion.ID_usuario2 or Usuario.ID_usuario = Conversacion.ID_usuario1) and 
        Usuario.NombreUsuario not like (select NombreUsuario from Usuario where ID_usuario = :id_usuario)");
            
        $consulta->bindParam(":id_usuario", $currentUserId, PDO::PARAM_INT);
        $consulta->bindParam(":id_chat", $chatId, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_NUM);
        return $data[0];
        
    }

    public function getUsernameById($userId) {
        $consulta = $this->db->prepare("select NombreUsuario from Usuario where ID_usuario = :id_usuario");
            
        $consulta->bindParam(":id_usuario", $userId, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_NUM);
        return $data[0];
    }

    public function getMessages($idChat) {
        $consulta = $this->db->prepare("select * from Mensaje where ID_conversacion = :id_chat");
            
        $consulta->bindParam(":id_chat", $idChat, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    function insertMessage($id_conversacion, $userId, $mensaje) {
        try {
            $consulta = $this->db->prepare("insert into Mensaje (ID_usuario, ID_conversacion, Cuerpo) values (:userId, :chatId, :mensaje)");
            
            $consulta->bindParam(":userId", $userId, PDO::PARAM_INT);
            $consulta->bindParam(":chatId", $id_conversacion, PDO::PARAM_INT);
            $consulta->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
    
            $results = $consulta->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }
}

?>

