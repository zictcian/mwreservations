<?php
include 'conexion.php';
$Idsitio=$_POST['Idsitio'];
if($Idsitio!=''){
    $queryResult=$connect->query("SELECT * FROM sitio WHERE sitio.id='$Idsitio'");
    $queryResult2=$connect->query("SELECT horariositio.dia, horariositio.horaIni, horariositio.horaFin FROM horariositio INNER JOIN sitio on horariositio.idSitio = sitio.id WHERE sitio.id='$Idsitio'");
    $result=$queryResult->fetch_assoc();
    $result2=array();
    while($fetchData2=$queryResult2->fetch_assoc()){
        $result2[]=$fetchData2;
    }
    $array = [
        "sitio" => $result,
        "horario" => $result2
    ];
    echo json_encode($array);
}else{
    echo json_encode('error');
}
?>