<?php 

function checkSignUpForm($user, $mail, $passwd, &$array):bool {
    if (!isset($user)  || strlen($user) < 4) {
        $array["user"] = "El usuario debe tener al menos 4 caracteres";
        return false;
    }
    if (!isset($mail)) {
        $array["mail"] = "El correo no es valido";
        return false;
    }

    if (!isset($passwd) || strlen($passwd) < 8) {
        $array["passwd"] = "La contraseña debe tener al menos 8 caracteres";
        return false;
    }

    return true;
}

?>