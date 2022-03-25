<?php
include 'conexion.php';
$IdSitio=$_POST['Idsitio'];
$queryResult=$connect->query("SELECT * FROM sitio INNER JOIN categoria on categoria.id = sitio.IdCategoria WHERE sitio.id='$IdSitio'");

$result=$queryResult->fetch_assoc();
    echo json_encode($result);
?>