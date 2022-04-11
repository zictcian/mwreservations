<?php
include 'conexion.php';
$idSitio=$_POST['id'];
if($idSitio){
    $queryResult=$connect->query("SELECT * FROM sitio Where id='$idSitio'");
}
$result=$queryResult->fetch_assoc();
echo json_encode($result);
?>