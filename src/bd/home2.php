<?php
include 'conexion.php';
$IdSitio=$_POST['IdSitio'];
$queryResult=$connect->query("SELECT * FROM sitio WHERE id != '$IdSitio' Limit 3");

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>