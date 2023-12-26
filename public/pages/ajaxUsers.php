<?php

include("../../storage/classes/DbConector.php");

$filter = $_GET["filter"];

$consultor = DbConector::singleton();

$array = $consultor->getUsersBySearch($filter);
echo (json_encode($array));

?>
