<?php
include 'conexion.php';
$idUsua=$_POST['idUsua'];
$correo=$_POST['correo'];
$nombre=$_POST['nombre'];
$Apaterno=$_POST['Apaterno'];
$Amaterno=$_POST['Amaterno'];
$pass=$_POST['password'];
$validacion=$_POST['validacion'];
$queryResult=$connect->query("SELECT * FROM usuario WHERE usuario.id='$idUsua'");
$filas = $queryResult->fetch_all(MYSQLI_ASSOC);
if(!empty($filas)){
    $connect->query("UPDATE usuario SET nombre='$nombre', Apaterno='$Apaterno', Amaterno='$Amaterno', correo='$correo', passencryp='$pass' Where id='$idUsua'");
    $queryResult=$connect->query("SELECT * FROM usuario Where id='$idUsua'");
    $result=$queryResult->fetch_assoc();
    echo json_encode($result);
}else{
    echo json_encode([]);
}
?>