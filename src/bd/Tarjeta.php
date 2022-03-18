<?php
include 'conexion.php';
$IdUsua=$_POST['Idsitio'];
$queryResult=$connect->query("SELECT * FROM sitio INNER JOIN categoria on categoria.id = sitio.IdCategoria WHERE sitio.id='$IdUsua'");

$result=$queryResult->fetch_assoc();
    echo json_encode($result);
?>