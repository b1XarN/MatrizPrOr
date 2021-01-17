<?php 
    require_once '../conexion.php';
    
    if(is_numeric($_GET['id'])){
        $sqlE = "UPDATE EMPRESA SET estado=0 WHERE idEmpresa = $_GET[id]";

        $eliminarE = mysqli_query($con, $sqlE);

        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];


        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Eliminacion de la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);

        header('Location: ../menu.php');        

        // $empresa = mysqli_fetch_assoc($empresas);
    }else{
        $sqlU = "UPDATE USUARIO SET estadoU=0 WHERE loginU = '$_GET[id]'";

        $eliminarU = mysqli_query($con,$sqlU);

        $sqlUs = "SELECT * FROM USUARIO WHERE loginU = '$_GET[id]' ";
        $usuarios = mysqli_query($con, $sqlUs);
        $usuario = mysqli_fetch_assoc($usuarios);
        $nombreUsuario = $usuario['loginU'];

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Eliminacion del usuario '.$nombreUsuario;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);

        header('Location: ../usuarios.php');
    }


?>