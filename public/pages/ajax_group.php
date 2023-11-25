<?php

include("../../storage/classes/DbConector.php");

$chatId = $_GET["idChat"];
$lastMessage = $_GET["ultimoMensaje"];

$consultor = DbConector::singleton();

$array = $consultor->getGroupLeftMessages($chatId, $lastMessage);
echo (json_encode($array));
?>