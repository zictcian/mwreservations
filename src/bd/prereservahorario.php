<?php
include 'conexion.php';
$Idsitio=$_POST['Idsitio'];
$fecha=$_POST['fecha'];
$dia=$_POST['dia'];
if($Idsitio!='' && $fecha!='' && $dia!=''){
    $queryResult=$connect->query("SELECT horariositio.id,horariositio.horaIni, horariositio.horaFin FROM horariositio INNER JOIN sitio on horariositio.idSitio = sitio.id INNER JOIN reservacion on reservacion.idHorarioSitio = horariositio.id 
    WHERE sitio.id='$Idsitio' AND reservacion.fecha = '$fecha' GROUP BY horariositio.id;");
    $result2=array();
    $result=array();
    while($fetchData=$queryResult->fetch_assoc()){
        $result[]=$fetchData;
        $IdHorario=$fetchData['id'];
        $resultado=$connect->query("SELECT Count(*) as limite FROM horariositio INNER JOIN sitio on horariositio.idSitio = sitio.id INNER JOIN reservacion on reservacion.idHorarioSitio = horariositio.id 
        WHERE sitio.id='$Idsitio' AND reservacion.fecha = '$fecha' AND horariositio.id='$IdHorario';");
        $fetchData2=$resultado->fetch_assoc();
        array_push($result2,$fetchData2);
    }

    $queryResult3=$connect->query("SELECT horariositio.id,horariositio.horaIni, horariositio.horaFin, sitio.limite FROM horariositio INNER JOIN sitio on horariositio.idSitio = sitio.id 
    WHERE sitio.id='$Idsitio' AND horariositio.dia = '$dia';");
    $result3=array();
    while($fetchData3=$queryResult3->fetch_assoc()){
        $result3[]=$fetchData3;
    }   

    $horarios = array(
        "horario" => $result3,
        "maximo"  => $result2,
        "seleccion" => $result
    );
    echo json_encode($horarios);
}else{
    echo json_encode('error');
}
?>