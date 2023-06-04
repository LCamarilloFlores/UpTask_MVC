<?php

$db = mysqli_connect('localhost', 'root', 'asd123', 'uptask_mvc');

try{
if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
}
catch(Exception $e){
    //debuguear($e);
}
