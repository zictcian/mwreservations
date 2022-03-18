<?php
include 'conexion.php';
$buscar=$_POST['busqueda'];
if($buscar == ''){
 echo 'Error';
}else{
    $queryResult=$connect->query("SELECT * FROM sitio where sitio.nombre LIKE '%$buscar%'");
}
$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>