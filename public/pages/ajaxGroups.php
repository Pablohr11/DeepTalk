<?php

session_start();
include("../../storage/classes/DbConector.php");

$chatId = $_GET["idChat"];

$consultor = DbConector::singleton();

$array = $consultor->getUserLeftGroups($chatId);
echo (json_encode($array));
?>