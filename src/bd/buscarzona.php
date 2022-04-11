<?php
include 'conexion.php';
$zona=$_POST['zona'];
$queryResult=$connect->query("SELECT id, estado FROM estados where estados.estado='$zona' LIMIT 1");

$fetchData=$queryResult->fetch_assoc();
    echo json_encode($fetchData);
?>