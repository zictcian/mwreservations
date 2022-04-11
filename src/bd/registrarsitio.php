<?php
include 'conexion.php';
$correo=$_POST['correo'];
$nombre=$_POST['nombre'];
$Apaterno=$_POST['Apaterno'];
$Amaterno=$_POST['Amaterno'];
$pass=$_POST['password'];
$local=$_POST['local'];
$zona=$_POST['zona'];
$cat=$_POST['cat'];
$queryResult=$connect->query("SELECT * FROM usuario WHERE usuario.correo='$correo'");
$filas = $queryResult->fetch_all(MYSQLI_ASSOC);
if(empty($filas)){
    $connect->query("INSERT INTO usuario (nombre, Apaterno, Amaterno, correo, passencryp, idnivelcuenta) VALUES ('$nombre', '$Apaterno', '$Amaterno', '$correo', '$pass', '2');");
    $queryResult2=$connect->query("SELECT * FROM usuario WHERE usuario.correo='$correo'");
    $filas2 = $queryResult2->fetch_assoc();
    if($filas2){
        $id=$filas2['id'];
        $connect->query("INSERT INTO sitio(nombre, IdCategoria,idUsuario, idEstado) VALUES ('$local','$cat','$id', '$zona')");
        echo json_encode('listo');
    }else{
        echo json_encode('error sitio');
    }
}else{
    echo json_encode('error');
}
?>