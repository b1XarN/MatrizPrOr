<?php 
    require_once 'conexion.php'; 

    if(isset($_POST['submitEmpresa'])){
        var_dump($_POST);

        $nombreEmpresa = isset($_POST['nombreEmpresa']) ? $_POST['nombreEmpresa'] : false;
        $ruc = isset($_POST['ruc']) ? $_POST['ruc'] : false;
        $mision = isset($_POST['mision']) ? $_POST['mision'] : false;
        $vision = isset($_POST['vision']) ? $_POST['vision'] : false;
        $valor = isset($_POST['valor']) ? $_POST['valor'] : false;
        $factor = isset($_POST['factor']) ? $_POST['factor'] : false;
        $objetivos = isset($_POST['objetivos']) ? $_POST['objetivos'] : false;
        $estado = 1;

        $sql = "INSERT INTO EMPRESA VALUES(null, '$nombreEmpresa', '$ruc', '$mision', '$vision', '$valor', '$factor', '$objetivos', $estado)";
        $guardar = mysqli_query($con, $sql);

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Registro de la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);


        header('Location: menu.php');
    
    }

?>