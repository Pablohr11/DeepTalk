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
            $consulta = $this->db->prepare("select ID_usuario, NombreUsuario, Contraseña, Correo, Telefono, rutaImagenPerfil from Usuario where NombreUsuario = :username");
            
            $consulta->bindParam(":username", $user, PDO::PARAM_STR);
            //$consulta->bindParam(":passwd", $passwd, PDO::PARAM_STR);
    
            $results = $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
    
    //        foreach ($data as $usuario) {
            if ($data["NombreUsuario"] == $user && password_verify($passwd, $data["Contraseña"] )) {
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
            
            $passwdHash = password_hash($passwd, PASSWORD_DEFAULT);
            echo $passwdHash;
            $consulta = $this->db->prepare("insert into Usuario (NombreUsuario, Contraseña, Correo, Tipo, rutaImagenPerfil) values (:username, :passwd, :mail, 'base', '../resources/perfiles/usuarioDefault.png')");

            
            $consulta->bindParam(":username", $user, PDO::PARAM_STR);
            $consulta->bindParam(":passwd", $passwdHash, PDO::PARAM_STR);
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

    public function getUserGroups($id) {
        $consulta = $this->db->prepare("select * from Grupo where Grupo.ID_grupo in (select ID_grupo from GrupoUsuario where ID_usuario = :id_usuario)");
            
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


    public function getGroupMessages($idChat) {
        $consulta = $this->db->prepare("select * from MensajeGrupal where ID_grupo = :id_chat");
            
        $consulta->bindParam(":id_chat", $idChat, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    function insertMessage($id_conversacion, $userId, $mensaje, $tipo) {
        try {
            $consulta = $this->db->prepare("insert into Mensaje (ID_usuario, ID_conversacion, Fecha, Cuerpo, Tipo) values (:userId, :chatId, SYSDATE(), :mensaje, :tipoMensaje)");
            
            $consulta->bindParam(":userId", $userId, PDO::PARAM_INT);
            $consulta->bindParam(":chatId", $id_conversacion, PDO::PARAM_INT);
            $consulta->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
            $consulta->bindValue(":tipoMensaje", $tipo, PDO::PARAM_STR);
    
            $results = $consulta->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    function insertGroupMessage($id_grupo, $userId, $mensaje, $tipo) {
        try {
            $consulta = $this->db->prepare("insert into MensajeGrupal (ID_usuario, ID_grupo, Fecha, Cuerpo, Tipo) values (:userId, :chatId, SYSDATE(), :mensaje, :tipoMensaje)");
            
            $consulta->bindParam(":userId", $userId, PDO::PARAM_INT);
            $consulta->bindParam(":chatId", $id_grupo, PDO::PARAM_INT);
            $consulta->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
            $consulta->bindValue(":tipoMensaje", $tipo, PDO::PARAM_STR);
    
            $results = $consulta->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    function getLastMessageFromChat($idChat) {
        $consulta = $this->db->prepare("select Num_Mensaje from Mensaje where ID_conversacion = :id_chat order by Num_Mensaje desc");
            
        $consulta->bindParam(":id_chat", $idChat, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_NUM);
        return $data[0];
    }

    public function getChatLeftMessages($idChat, $lastMessage) {
        $consulta = $this->db->prepare("select * from Mensaje where ID_conversacion = :id_chat and Num_Mensaje > :last_message");
            
        $consulta->bindParam(":id_chat", $idChat, PDO::PARAM_INT);
        $consulta->bindParam(":last_message", $lastMessage, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetchAll(PDO::FETCH_NUM);
        return $data;
    }


    function getLastMessageFromGroup($idGroup) {
        $consulta = $this->db->prepare("select Num_Mensaje from MensajeGrupal where ID_grupo = :id_chat order by Num_Mensaje desc");
            
        $consulta->bindParam(":id_chat", $idGroup, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_NUM);
        return $data[0];
    }

    public function getGroupLeftMessages($idGrupo, $lastMessage) {
        $consulta = $this->db->prepare("select * from MensajeGrupal where ID_grupo = :id_chat and Num_Mensaje > :last_message");
            
        $consulta->bindParam(":id_chat", $idGrupo, PDO::PARAM_INT);
        $consulta->bindParam(":last_message", $lastMessage, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetchAll(PDO::FETCH_NUM);
        return $data;
    }


    public function obtenerUsuario($userName){
        $consulta = $this->db->prepare("SELECT NombreUsuario FROM Usuario WHERE NombreUsuario=:userName");
        $consulta->bindParam(":userName", $userName, PDO::PARAM_STR);
        $resultado = $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_NUM);
        return $usuario;
    }

    public function obtenerMail($mail){
        $consulta = $this->db->prepare("SELECT Correo FROM Usuario WHERE Correo=:mail");
        $consulta->bindParam(":mail", $mail, PDO::PARAM_STR);
        $resultado = $consulta->execute();
        $mail = $consulta->fetch(PDO::FETCH_NUM);
        return $mail;
    }

    public function obtenerContraDeUsuario($userName){
        $consulta = $this->db->prepare("SELECT Contraseña FROM Usuario WHERE NombreUsuario=:userName");
        $consulta->bindParam(":userName", $userName, PDO::PARAM_STR);
        $resultado = $consulta->execute();
        $contra = $consulta->fetch(PDO::FETCH_NUM);
        return $contra;
    }

    public function getUserIdFromName($otherUserName) {
        $consulta = $this->db->prepare("select ID_usuario from Usuario where NombreUsuario = :userName");

        $consulta->bindParam(":userName", $otherUserName, PDO::PARAM_STR);

        $results = $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_NUM);
        return $data[0];
    }

    public function createPrivateChat($userId, $otherUserName) {
        try {

            $otherUserId = $this->getUserIdFromName($otherUserName);

            $consulta = $this->db->prepare("insert into Conversacion (ID_usuario1, ID_usuario2) values (:userId, :otherUserId)");

            $consulta->bindParam(":userId", $userId, PDO::PARAM_INT);
            $consulta->bindParam(":otherUserId", $otherUserId, PDO::PARAM_INT);

            $results = $consulta->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    function getGroupName($groupId) {
        $consulta = $this->db->prepare("select NombreGrupo from Grupo where ID_grupo = :id_grupo");
            
        $consulta->bindParam(":id_grupo", $groupId, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetch(PDO::FETCH_NUM);
        return $data[0];
    }

    function getGroupUsers($groupId) {
            $consulta = $this->db->prepare("select ID_usuario, NombreUsuario from Usuario where ID_usuario in (select ID_usuario from GrupoUsuario where GrupoUsuario.ID_grupo = :id_grupo);");
                
            $consulta->bindParam(":id_grupo", $groupId, PDO::PARAM_INT);
    
            $results = $consulta->execute();
            $data = $consulta->fetchAll(PDO::FETCH_NUM);
            return $data;
    }

    public function getGroupId($groupName) {

        echo "joderFoco";

        $consulta = $this->db->prepare("select ID_grupo from Grupo where NombreGrupo = :nombre_grupo");
                
        $consulta->bindParam(":nombre_grupo", $groupName, PDO::PARAM_INT);

        $results = $consulta->execute();
        $data = $consulta->fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    public function createGroupChat($groupName, $userId) {
        try {

            $consulta = $this->db->prepare("insert into Grupo (NombreGrupo, ID_usuario) values (:groupName, :userId)");

            $consulta->bindParam(":groupName", $groupName, PDO::PARAM_STR);
            $consulta->bindParam(":userId", $userId, PDO::PARAM_INT);

            $results = $consulta->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function insertIntoGroup($userId, $groupId) {
        try {
            echo "joder";
            $consulta = $this->db->prepare("insert into GrupoUsuario values(:groupId, :userId)");

            $consulta->bindParam(":userId", $userId, PDO::PARAM_INT);
            $consulta->bindParam(":groupId", $groupId, PDO::PARAM_INT);

            $results = $consulta->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function actualizarRutaFotoPerfil($userId, $ruta) {
        
        $consulta = $this->db->prepare("UPDATE Usuario SET rutaImagenPerfil=:rutaImagen WHERE ID_usuario = :username");

        $consulta->bindParam(":rutaImagen", $ruta, PDO::PARAM_STR);
        $consulta->bindParam(":username", $userId, PDO::PARAM_INT);
        $results = $consulta->execute();
        
    }

}
?>

