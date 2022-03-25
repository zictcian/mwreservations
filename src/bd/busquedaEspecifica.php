<?php
include 'conexion.php';
$buscar=$_POST['busqueda'];
$idZona=$_POST['idZona'];
if($buscar == ''){
 echo 'Error';
}else{
    if($idZona!=''){
        $queryResult=$connect->query("SELECT * FROM sitio INNER JOIN estados on estados.id = sitio.idEstado where sitio.nombre LIKE '%$buscar%' and estados.id='$idZona'");
    }else{
        $queryResult=$connect->query("SELECT * FROM sitio where sitio.nombre LIKE '%$buscar%'");
    }
}
$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
    echo json_encode($result);
?>