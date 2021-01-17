<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitActualizar'])){
        var_dump($_POST);
        
        $sql1 = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id]";

        $empresas = mysqli_query($con, $sql1);

        $empresa = mysqli_fetch_assoc($empresas);

        var_dump($empresa);

        $idE = $empresa['idEmpresa'];
        $nuevoNombre = $empresa['nombre'];
        $nuevoRUC = $empresa['RUC'];
        if($_POST['mision'] == ''){
            $nuevaMision = $empresa['mision'];
        }else{
            $nuevaMision = $_POST['mision'];
        }
        if($_POST['vision'] == ''){
            $nuevaVision = $empresa['vision'];
        }else{
            $nuevaVision = $_POST['vision'];
        }
        if($_POST['valor'] == ''){
            $nuevaPropuesta = $empresa['propuestaValor'];
        }else{
            $nuevaPropuesta = $_POST['valor'];
        }
        if($_POST['factor'] == ''){
            $nuevoFactor = $empresa['factorDiferenciador'];
        }else{
            $nuevoFactor = $_POST['factor'];
        }
        if($_POST['objetivos'] == ''){
            $nuevoObjetivo = $empresa['objetivo'];
        }else{
            $nuevoObjetivo = $_POST['objetivos'];
        }
        
        $sql2 = "UPDATE EMPRESA SET mision = '$nuevaMision', vision = '$nuevaVision', propuestaValor = '$nuevaPropuesta', factorDiferenciador = '$nuevoFactor', objetivo = '$nuevoObjetivo' where idEmpresa = $idE";
        $actualizar = mysqli_query($con, $sql2);

        $sqlEm = "SELECT * FROM EMPRESA WHERE idEmpresa = $_GET[id] ";
        $empresas = mysqli_query($con, $sqlEm);
        $empresa = mysqli_fetch_assoc($empresas);
        $nombreEmpresa = $empresa['nombreEmpresa'];

        $usuario = $_SESSION['usuario']['loginU'];
        $operacion = 'Edito los datos de la empresa '.$nombreEmpresa;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);

        header('Location: ../empresa.php?id='.$idE);

        
        
    }else{
        echo 'ALGO SALIO MAL!!!!!!';
    }

?>