<?php 
    require_once("DbConector.php");
function checkSignUpForm($user, $mail, $passwd, &$array):bool {
    $formValid = true;
    define("EXPRESION_REGULAR_CORREO", "/[a-zA-Z0-9]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9]+([.][a-zA-Z0-9]+)*[.][a-zA-Z]{2,5}/");
    $db = DbConector::singleton();

    $existeUsuario = $db->obtenerUsuario($user);
    $existeMail = $db->obtenerMail($mail);

    if (!isset($user)  || strlen($user) < 4) {
        $array["usuario"] = "El usuario debe tener al menos 4 caracteres";
        $formValid = false;
    }else if($existeUsuario!=null){
        $array["usuario"] = "El usuario '". $existeUsuario[0] ."' ya existe.";
        $formValid = false;
    }

    if (!isset($mail) || !preg_match(EXPRESION_REGULAR_CORREO, $mail)) {
        $array["mail"] = "El correo no es valido";
        $formValid = false;
    }else if($existeMail!=null){
        $array["mail"] = "El correo '". $existeMail[0] ."' ya esta en uso.";
        $formValid = false;
    }

    if (!isset($passwd) || strlen($passwd) < 8) {
        $array["contrasena"] = "La contraseña debe tener al menos 8 caracteres";
        $formValid = false;
    }

    return $formValid;
}

function checkSignInForm($user, $passwd, &$array):bool {
    $formValid = true;
    $db = DbConector::singleton();

    $existeUsuario = $db->obtenerUsuario($user);
    $contraUser = $db->obtenerContraDeUsuario($user);

    if (!isset($user)  || strlen($user) < 4) {
        $array["usuario"] = "El usuario debe tener al menos 4 caracteres";
        $formValid = false;
    }else if($existeUsuario==null){
        $array["usuario"] = "El usuario '". $user ."' no existe.";
        $formValid = false;
    }
    if($formValid){
        if (!isset($passwd) || strlen($passwd) < 8) {
            $array["contrasena"] = "La contraseña debe tener al menos 8 caracteres";
            $formValid = false;
        }else if($contraUser[0]!=$passwd){
            $array["contrasena"] = "La contraseña no es correcta.";
            $formValid = false;
        }
    }

    return $formValid;
}

?>
