<?php 
    require_once 'conexion.php';

    if(isset($_POST['submitAsignar'])){
        $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $_GET[id] and estadoOr = 1";
        $organizaciones = mysqli_query($con, $sqlO);
        while($organizacion = mysqli_fetch_assoc($organizaciones)):
            $idOrganizacion = $organizacion['idOrganizacion']; 
            $asignacion = $_POST[$organizacion['nombreOrganizacion']];
            $sqlDA = "UPDATE DETALLE_ASIGNACION set asignacion = '$asignacion' where idOrganizacion = $idOrganizacion and idSubProceso = $_SESSION[subproceso] and idEmpresa = $_GET[id]";
            $sqlguardar = mysqli_query($con, $sqlDA);
        endwhile;
        header('Location: empresa.php?id='.$_GET['id']);
    }else{
        echo 'ALGO SALIO MAAAAAL!!';
    }

?>