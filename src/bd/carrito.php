<?php
include 'conexion.php';
$IdUsua=$_POST['IdUsua'];
$queryResult=$connect->query("SELECT * FROM reservacion INNER JOIN sitio on reservacion.idSitio = sitio.id WHERE reservacion.idUsuario='$IdUsua' 
ORDER BY reservacion.idEstatus,reservacion.fecha");

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>