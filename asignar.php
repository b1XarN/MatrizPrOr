<?php 
    require_once 'conexion.php';

    if(isset($_POST['submitAsignar'])){
        $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $_GET[id] and estadoOr = 1";
        $organizaciones = mysqli_query($con, $sqlO);
        while($organizacion = mysqli_fetch_assoc($organizaciones)):
            $idOrganizacion = $organizacion['idOrganizacion'];
            $nombreOrg = str_replace(" ","_",$organizacion['nombreOrganizacion']);
            $asignacion = $_POST[$nombreOrg];
            $sqlDA = "UPDATE DETALLE_ASIGNACION set asignacion = '$asignacion' where idOrganizacion = $idOrganizacion and idSubProceso = $_SESSION[subproceso] and idEmpresa = $_GET[id]";
            $sqlguardar = mysqli_query($con, $sqlDA);
        endwhile;

        $sqlsP = "SELECT * FROM SUBPROCESO WHERE idSubProceso = $_SESSION[subproceso] ";
        $subprocesos = mysqli_query($con, $sqlsP);
        $subproceso = mysqli_fetch_assoc($subprocesos);


        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Cambio de la asignacion del subproceso '.$subproceso['nombreSub'].' en la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);

        header('Location: empresa.php?id='.$_GET['id']);
    }else{
        echo 'ALGO SALIO MAAAAAL!!';
    }

    

?>