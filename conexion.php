<?php 
    $servidor = 'localhost';
    $usuario = 'root';
    $password = '';
    $base_datos = 'bdpror';

    $con = mysqli_connect($servidor, $usuario, $password, $base_datos);
 
    session_start();


?>