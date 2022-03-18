<?php
include 'conexion.php';
$IdSitio=$_POST['IdSitio'];
$IdUsua=$_POST['IdUsua'];
$queryResult=$connect->query("SELECT favorite FROM favoritos WHERE favoritos.idSitio='$IdSitio' and favoritos.idUsuario='$IdUsua'");

$result=$queryResult->fetch_assoc();
echo json_encode($result);
?>