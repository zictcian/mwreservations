<?php
include 'conexion.php';
$IdSitio=$_POST['idsitio'];
$queryResult=$connect->query("SELECT * FROM comentarios INNER JOIN sitio on comentarios.idSitio = sitio.id INNER JOIN usuario on usuario.id = comentarios.idUsuario WHERE sitio.id='$IdSitio'");

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>