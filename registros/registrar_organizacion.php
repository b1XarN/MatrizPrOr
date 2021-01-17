<?php 
    require_once '../conexion.php';

    if(isset($_POST['submitOrganizacion'])){
        $nombreOrg = $_POST['organizacion'];
        $idEmpresa = $_GET['id'];

        $sql = "INSERT INTO ORGANIZACION VALUES(null, $idEmpresa, '$nombreOrg', 1)";
        $guardar = mysqli_query($con, $sql);

        $sqlsP = "SELECT * FROM SUBPROCESO WHERE idEmpresa = $idEmpresa and estadoSub = 1";
        $subprocesos = mysqli_query($con, $sqlsP);
        
        

        if(mysqli_num_rows($subprocesos) >= 1){
            $sqlOrg = "SELECT * FROM ORGANIZACION WHERE idOrganizacion=(SELECT max(idOrganizacion) FROM ORGANIZACION)";
            $orgs = mysqli_query($con, $sqlOrg);
            $org = mysqli_fetch_assoc($orgs);
            $idOrg = $org['idOrganizacion'];
            while($subproceso = mysqli_fetch_assoc($subprocesos)):
                $idSubProceso = $subproceso['idSubProceso'];
                $sqlDA= "INSERT INTO DETALLE_ASIGNACION VALUES($idOrg, $idSubProceso, $idEmpresa, 'Sin participacion')";
                $guardar2 = mysqli_query($con, $sqlDA);
            endwhile;
        }

        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Registro de la organizacion '.$nombreOrg.' en la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);

        header('Location: ../empresa.php?id='.$_GET['id']);
        
    }else{
        echo 'ALGO SALIO MAAAL';
    }
?>