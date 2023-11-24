<?php 

function checkSignUpForm($user, $mail, $passwd, &$array):bool {
    if (!isset($user)  || strlen($user) < 4) {
        $array["user"] = "El usuario debe tener al menos 4 caracteres";
    }
    if (!isset($mail)) {
        $array["mail"] = "El correo no es valido";
    }

    if (!isset($passwd) || strlen($passwd) < 8) {
        $array["passwd"] = "La contraseña debe tener al menos 8 caracteres";
    }

    if (isset($array["user"]) || isset($array["mail"]) || isset($array["passwd"])) {
        return false;
    } 

    return true;
}

?>