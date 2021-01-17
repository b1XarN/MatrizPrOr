<?php 
    require_once '../conexion.php';

    if(isset($_POST['submitProceso'])){
        $nuevoP = $_POST['proceso'];
        $estado = 1;

        $sqlnP = "INSERT INTO PROCESO VALUES(null, $_GET[id], '$nuevoP', $estado)";
        $guardar= mysqli_query($con, $sqlnP);

        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Registro del proceso '.$nuevoP.' en la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);

        header('Location: ../empresa.php?id='.$_GET['id']);

    }else{
        echo 'ALGO SALIO MAAAL!!';
    }
?>