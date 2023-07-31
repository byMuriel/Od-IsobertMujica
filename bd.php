<?php
include ".env"; //incluimos el archivo con las variables de entorno

try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$contrasenia);
}catch(Exception $ex){
    echo $ex->getMessage();
}
?>