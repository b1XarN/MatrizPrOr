<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitRegistrar']))
    {
        $proc = $_POST['procesos']; 
        $subproc = $_POST['subproceso'];

        $sqlP = "SELECT * FROM PROCESO where idEmpresa = $_GET[id] and idProceso = $proc and estadoProceso = 1";
        $procesos = mysqli_query($con, $sqlP);
        $proceso = mysqli_fetch_assoc($procesos);
        $idProceso = $proceso['idProceso'];
        $idEmpresa = $_GET['id'];

        $sql = "INSERT INTO SUBPROCESO VALUES(null, '$subproc', 1, $idProceso, $idEmpresa)";
        $guardar = mysqli_query($con,$sql);

        $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $_GET[id] and estadoOr =1";
        $organizaciones = mysqli_query($con, $sqlO);

        if(mysqli_num_rows($organizaciones)>=1){
            $sqlsubproc2 = "SELECT * FROM SUBPROCESO WHERE idSubProceso=(SELECT max(idSubProceso) FROM SUBPROCESO)";
            $subprocesos = mysqli_query($con, $sqlsubproc2);
            $subproceso = mysqli_fetch_assoc($subprocesos);
            $idSubProceso = $subproceso['idSubProceso'];
            while($organizacion = mysqli_fetch_assoc($organizaciones)):
                $idOrganizacion = $organizacion['idOrganizacion'];
                $sqlDA = "INSERT INTO DETALLE_ASIGNACION VALUES($idOrganizacion, $idSubProceso, $idEmpresa, 'Sin participacion')";
                $guardar2 = mysqli_query($con, $sqlDA);
            endwhile;
        }

        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Registro del subproceso '.$subproc.' del proceso '.$proceso['nombreProceso'].' en la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);

        header('Location: ../empresa.php?id='.$_GET['id']);
    }else{
        echo 'ALGO SALIO MAL!!';
    }

?>