<?php
include 'conexion.php';
$cat=$_POST['cat'];
$idZona=$_POST['idZona'];
if($idZona!=''){
    $queryResult=$connect->query("SELECT * FROM categoria inner join sitio on categoria.id = sitio.IdCategoria INNER JOIN estados ON estados.id = sitio.idEstado where categoria.categoria='$cat' and estados.id='$idZona'");
}else{
    $queryResult=$connect->query("SELECT * FROM categoria inner join sitio on categoria.id = sitio.IdCategoria where categoria.categoria='$cat'");
}

$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>