<?php
include 'conexion.php';

$idUsua=$_POST['id'];
$queryResult=$connect->query("SELECT * FROM usuario Where id='$idUsua'");

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>