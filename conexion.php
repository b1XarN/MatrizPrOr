<?php 
    $servidor = 'localhost';
    $usuario = 'root';
    $password = '';
    $base_datos = 'bdpror';

    $con = mysqli_connect($servidor, $usuario, $password, $base_datos);
    
    date_default_timezone_set('America/Lima');
    session_start();


?>