<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitEliminar'])){
        $idOrganizacion = $_SESSION['organizacion'];
        $sqlO = "UPDATE ORGANIZACION SET estadoOr = 0 where idOrganizacion = $idOrganizacion";
        $guardar = mysqli_query($con, $sqlO);



        //------------------------------------------------------------- audtoria
        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $sqlOr = "SELECT * FROM ORGANIZACION where idOrganizacion = $idOrganizacion";
        $organizaciones = mysqli_query($con, $sqlOr);
        $organizacion = mysqli_fetch_assoc($organizaciones);

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Elimacion de la organizacion '.$organizacion['nombreOrganizacion']. ' de la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);
        //------------------------------------------------------------- audtoria

        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }

?>