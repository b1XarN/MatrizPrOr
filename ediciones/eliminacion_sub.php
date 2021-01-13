<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitEliminar'])){
        $idSubProceso = $_SESSION['subproceso'];
        $sqlnS = "UPDATE SUBPROCESO SET estadoSub = 0 where idSubProceso = $idSubProceso";
        $guardar = mysqli_query($con, $sqlnS);
        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }

?>