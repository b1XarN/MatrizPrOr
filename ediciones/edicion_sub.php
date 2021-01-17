<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitActualizar'])){
        $nuevoSub = $_POST['nuevoSub'];
        $idSubProceso = $_SESSION['subproceso'];

        //------------------------------------------------------------- audtoria
        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $sqlsP = "SELECT * FROM SUBPROCESO where idSubProceso = $idSubProceso";
        $subprocesos = mysqli_query($con, $sqlsP);
        $subproceso = mysqli_fetch_assoc($subprocesos);

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Edicion del subproceso '.$subproceso['nombreSub']. ' a '.$nuevoSub.' de la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);
        //------------------------------------------------------------- audtoria





        $sqlnS = "UPDATE SUBPROCESO SET nombreSub = '$nuevoSub' where idSubProceso = $idSubProceso";
        $guardar = mysqli_query($con, $sqlnS);









        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }
?>