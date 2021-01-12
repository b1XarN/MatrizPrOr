<?php 
    require_once '../conexion.php';

    if(isset($_POST['submitProceso'])){
        $nuevoP = $_POST['proceso'];
        $estado = 1;

        $sqlnP = "INSERT INTO PROCESO VALUES(null, $_GET[id], '$nuevoP', $estado)";
        $guardar= mysqli_query($con, $sqlnP);

        header('Location: ../empresa.php?id='.$_GET['id']);

    }else{
        echo 'ALGO SALIO MAAAL!!';
    }
?>