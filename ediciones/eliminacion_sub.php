<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitEliminar'])){
        $idSubProceso = $_SESSION['subproceso'];
        $sqlnS = "UPDATE SUBPROCESO SET estadoSub = 0 where idSubProceso = $idSubProceso";
        $guardar = mysqli_query($con, $sqlnS);

        //------------------------------------------------------------- audtoria
        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $sqlsP = "SELECT * FROM SUBPROCESO where idSubProceso = $idSubProceso";
        $subprocesos = mysqli_query($con, $sqlsP);
        $subproceso = mysqli_fetch_assoc($subprocesos);

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Eliminacion del subproceso '.$subproceso['nombreSub'].' de la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);
        //------------------------------------------------------------- audtoria



        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }

?>