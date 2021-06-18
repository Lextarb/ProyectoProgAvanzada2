<?php

$server='192.185.131.135';
$username='javierc1_usuario';
$password='dental123';
$database='javierc1_Clinica_Dental';
try{
    $conn= new PDO("mysql:host=$server;dbname=$database;",$username,$password);
    echo 'Conexion Realizada';
} catch(PDOException $e) {
    die('Connected failed : ' .$e->getMessage());
}


?>