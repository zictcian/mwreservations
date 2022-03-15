<?php
include 'conexion.php';

$correo=$_POST['correo'];
$pass=$_POST['pass'];
$queryResult=$connect->query("SELECT * FROM usuario Where passencryp='$pass' AND correo='$correo'");

$result=$queryResult->fetch_assoc();
echo json_encode($result);
?>