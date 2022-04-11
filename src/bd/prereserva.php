<?php
include 'conexion.php';
$Idsitio=$_POST['Idsitio'];
if($Idsitio!=''){
    $queryResult=$connect->query("SELECT * FROM sitio WHERE sitio.id='$Idsitio'");
    $result=$queryResult->fetch_assoc();
    echo json_encode($result);
}else{
    echo json_encode('error');
}
?>