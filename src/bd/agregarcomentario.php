<?php
include 'conexion.php';
$IdSitio=$_POST['IdSitio'];
$IdUsua=$_POST['IdUsua'];
$mensaje=$_POST['comentario'];
$valoracion=$_POST['ponderacion'];
$fecha= date("Y-m-d H:i:s"); 
if($IdSitio !== null){
    $valido=$connect->query("INSERT INTO `comentarios`(idUsuario, Mensaje, idSitio, valoracion, fecha) 
VALUES ('$IdUsua','$mensaje','$IdSitio','$valoracion','$fecha');");
if($valido){
    echo json_encode('listo');
} else{
    echo json_encode('error');
}
} else{
    echo json_encode('error');
}
?>