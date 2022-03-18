<?php
include 'conexion.php';
$IdSitio=$_POST['IdSitio'];
$IdUsua=$_POST['IdUsua'];
$fav=$_POST['fav'];
$queryResult=$connect->query("SELECT favorite FROM favoritos WHERE favoritos.idSitio='$IdSitio' and favoritos.idUsuario='$IdUsua'");
$filas = $queryResult->fetch_all(MYSQLI_ASSOC);
if(!empty($filas)){
    $connect->query("UPDATE favoritos SET favorite='$fav', fecha=date('d-m-Y H:i:s') WHERE favoritos.idSitio='$IdSitio' and favoritos.idUsuario='$IdUsua';");
    echo json_encode('listo');
}else{
    echo json_encode('error');
}
?>