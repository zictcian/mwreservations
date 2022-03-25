<?php
include 'conexion.php';
$IdUsua=$_POST['IdUsua'];
$idZona=$_POST['idZona'];
if($idZona!=''){
    $queryResult=$connect->query("SELECT * FROM favoritos INNER JOIN sitio on favoritos.idSitio = sitio.id inner JOIN estados on estados.id = sitio.idEstado  WHERE favoritos.idUsuario='$IdUsua' and favorite !='0' and estados.id = '$idZona'");
}else{
    $queryResult=$connect->query("SELECT * FROM favoritos INNER JOIN sitio on favoritos.idSitio = sitio.id WHERE favoritos.idUsuario='$IdUsua' and favorite !='0'");
}

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>