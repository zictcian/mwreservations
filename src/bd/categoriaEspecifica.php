<?php
include 'conexion.php';
$cat=$_POST['cat'];
$queryResult=$connect->query("SELECT * FROM categoria inner join sitio on categoria.id = sitio.IdCategoria where categoria.categoria='$cat'");

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>