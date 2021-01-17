<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitActualizar'])){
        $nuevoOrg = $_POST['nuevoOrg'];
        $idOrg = $_SESSION['organizacion'];

        //------------------------------------------------------------- audtoria
        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $sqlOr = "SELECT * FROM ORGANIZACION where idOrganizacion = $idOrg";
        $organizaciones = mysqli_query($con, $sqlOr);
        $organizacion = mysqli_fetch_assoc($organizaciones);

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Edicion de la organizacion '.$organizacion['nombreOrganizacion']. ' a '.$nuevoOrg.' de la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);
        //------------------------------------------------------------- audtoria







        $sqlO = "UPDATE ORGANIZACION SET nombreOrganizacion = '$nuevoOrg' where idOrganizacion = $idOrg";
        $guardar = mysqli_query($con, $sqlO);
        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }
?>