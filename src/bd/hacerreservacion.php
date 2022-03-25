<?php
include 'conexion.php';
$IdSitio=$_POST['IdSitio'];
$IdUsua=$_POST['IdUsua'];
$comentario=$_POST['comentario'];
$minutosR=$_POST['minutosR'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$personas=$_POST['personas'];
$qr=$_POST['qr'];
$registro= date("Y-m-d H:i:s"); 
if($IdSitio !== null && $IdUsua !== null){
    $valido=$connect->query("INSERT INTO reservacion(descripcion, idSitio, idUsuario, minutosR, fecha, hora, comentario, recibo, idEstatus, personas, registro, qr) 
    VALUES ('','$IdSitio','$IdUsua','$minutosR','$fecha','$hora','$comentario','','1','$personas','$registro', '$qr');");
    if($valido){
        echo json_encode('listo');
    } else{
        echo json_encode('error');
    }
} else{
    echo json_encode('error');
}
?>