<?php
include 'conexion.php';
$idZona=$_POST['idZona'];
if($idZona){
    $queryResult=$connect->query("SELECT * FROM estados inner JOIN sitio on sitio.idEstado = estados.id WHERE estados.id='$idZona'");
    $result=array();
    while($fetchData=$queryResult->fetch_assoc()){
        $result[]=$fetchData;
    }
    fin($result);
}else{
    $queryResult=$connect->query("SELECT * FROM sitio");
    $result=array();
    while($fetchData=$queryResult->fetch_assoc()){
        $result[]=$fetchData;
    }
    fin($result);
}

function fin($result){
    echo json_encode($result);
}
?>