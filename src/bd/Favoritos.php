<?php
include 'conexion.php';
$IdUsua=$_POST['IdUsua'];
$queryResult=$connect->query("SELECT * FROM favoritos INNER JOIN sitio on favoritos.idSitio = sitio.id WHERE favoritos.idUsuario='$IdUsua' and favorite !='0'");

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>