<?php
include 'conexion.php';
$queryResult=$connect->query("SELECT * FROM categoria");
//SELECT * FROM `sitio` WHERE sitio.idCategoria=$categoria
$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>