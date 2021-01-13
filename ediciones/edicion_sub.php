<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitActualizar'])){
        $nuevoSub = $_POST['nuevoSub'];
        $idSubProceso = $_SESSION['subproceso'];
        $sqlnS = "UPDATE SUBPROCESO SET nombreSub = '$nuevoSub' where idSubProceso = $idSubProceso";
        $guardar = mysqli_query($con, $sqlnS);
        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }
?>