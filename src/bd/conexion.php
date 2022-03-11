<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
$connect = new mysqli("127.0.0.1:3306","root","","mwreservation");
$connect->query("SET NAMES 'utf8'");

if($connect){
}else{
    echo "Follo, revise la ip";
    exit();
}