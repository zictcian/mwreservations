<?php
include 'conexion.php';
$correo=$_POST['correo'];
$nombre=$_POST['nombre'];
$Apaterno=$_POST['Apaterno'];
$Amaterno=$_POST['Amaterno'];
$pass=$_POST['password'];
$queryResult=$connect->query("SELECT * FROM usuario WHERE usuario.correo='$correo'");
$filas = $queryResult->fetch_all(MYSQLI_ASSOC);
if(empty($filas)){
    $connect->query("INSERT INTO usuario (nombre, Apaterno, Amaterno, correo, passencryp) VALUES ('$nombre', '$Apaterno', '$Amaterno', '$correo', '$pass');");
    echo json_encode('listo');
}else{
    echo json_encode('error');
}
?>