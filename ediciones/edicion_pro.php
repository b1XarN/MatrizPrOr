<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitActualizar'])){
        $nuevoPro = $_POST['nuevoPro'];
        $idPro = $_SESSION['proceso'];

        //------------------------------------------------------------- audtoria
        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $sqlPr = "SELECT * FROM PROCESO where idProceso = $idPro";
        $procesos = mysqli_query($con, $sqlPr);
        $proceso = mysqli_fetch_assoc($procesos);

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Edicion del proceso '.$proceso['nombreProceso']. ' a '.$nuevoPro.' de la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);
        //------------------------------------------------------------- audtoria







        $sqlP = "UPDATE PROCESO SET nombreProceso = '$nuevoPro' where idProceso = $idPro";
        $guardar = mysqli_query($con, $sqlP);
        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }
?>