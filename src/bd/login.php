<?php
include 'conexion.php';
$correo=$_POST['correo'];
$pass=$_POST['pass'];
if($correo){
    $queryResult=$connect->query("SELECT * FROM usuario Where passencryp='$pass' AND correo='$correo' AND idestatuscuenta = '1'");
    $result=$queryResult->fetch_assoc();
    if($result){
        if($result['idnivelcuenta'] == '2'){
            $id=$result['id'];
            $queryResult2=$connect->query("SELECT * FROM sitio Where idUsuario = '$id'");
            $result2=$queryResult2->fetch_assoc();
            $datos = [ 
                'usuario'   => $result,
                'sitio'     => $result2
            ];
            echo json_encode($datos);
        }else{
            echo json_encode($result);
        }
    }else{
        echo json_encode('error');
    }
}
?>