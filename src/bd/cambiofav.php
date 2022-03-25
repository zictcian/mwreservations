<?php
include 'conexion.php';
$IdSitio=$_POST['IdSitio'];
$IdUsua=$_POST['IdUsua'];
$fav=$_POST['fav'];
$fecha= date("Y-m-d H:i:s"); 
$queryResult=$connect->query("SELECT favorite FROM favoritos WHERE favoritos.idSitio='$IdSitio' and favoritos.idUsuario='$IdUsua'");
$filas = $queryResult->fetch_all(MYSQLI_ASSOC);
if(!empty($filas)){
    $connect->query("UPDATE favoritos SET favorite='$fav', fecha='$fecha' WHERE favoritos.idSitio='$IdSitio' and favoritos.idUsuario='$IdUsua';");
    echo json_encode('listo');
}else{
    $connect->query("INSERT INTO favoritos( idUsuario, idSitio, fecha, favorite) VALUES ('$IdUsua','$IdSitio','$fecha','1')");
    echo json_encode('listo');
}
?>