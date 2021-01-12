<?php 
    require_once '../conexion.php';
    
    if(is_numeric($_GET['id'])){
        $sqlE = "UPDATE EMPRESA SET estado=0 WHERE idEmpresa = $_GET[id]";

        $eliminarE = mysqli_query($con, $sqlE);

        header('Location: ../menu.php');        

        // $empresa = mysqli_fetch_assoc($empresas);
    }else{
        $sqlU = "DELETE FROM USUARIO WHERE loginU = '$_GET[id]'";

        $eliminarU = mysqli_query($con,$sqlU);

        header('Location: ../usuarios.php');
    }


?>