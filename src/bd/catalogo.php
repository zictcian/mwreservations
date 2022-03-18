<?php
include 'conexion.php';
$IdUsua=$_POST['Idsitio'];
$queryResult=$connect->query("SELECT * FROM catalogo INNER JOIN sitio on catalogo.idSitio = sitio.id WHERE  sitio.id='$IdUsua'");

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>