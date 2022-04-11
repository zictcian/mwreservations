<?php
include 'conexion.php';
$IdSitio=$_POST['IdSitio'];
$IdUsua=$_POST['IdUsua'];
$comentario=$_POST['comentario'];
$fecha=$_POST['fecha'];
$IdHorario=$_POST['IdHorario'];
$personas=$_POST['personas'];
$qr=$_POST['qr'];
$registro= date("Y-m-d H:i:s"); 
if($IdSitio !== null && $IdUsua !== null){
    $valido=$connect->query("INSERT INTO reservacion(descripcion, idSitio, idUsuario, fecha, idHorarioSitio, comentario, recibo, idEstatus, personas, registro, qr) 
    VALUES ('','$IdSitio','$IdUsua','$fecha','$IdHorario','$comentario','','1','$personas','$registro', '$qr');");
    if($valido){
        echo json_encode($valido);
    } else{
        echo json_encode(false);
    }
} else{
    echo json_encode(false);
}
?>