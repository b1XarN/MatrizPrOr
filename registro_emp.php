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

        header('Location: menu.php');
    
    }

?>