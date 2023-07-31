<?php
session_start();
session_destroy(); //destruimos la sesion
header('location:index.php'); //redireccionmos al login para la autenticacion
?>