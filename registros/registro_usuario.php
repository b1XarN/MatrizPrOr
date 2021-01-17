<?php 
    if(isset($_POST['submitGuardar'])){

        require_once '../conexion.php';

        // session_start();

        $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
        $dni = isset($_POST['dni']) ? $_POST['dni'] : false;
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        $tipo= isset($_POST['tipo']) ? $_POST['tipo'] : false;

        $sql = "INSERT INTO USUARIO VALUES('$usuario', '$nombres', '$dni', '$direccion', '$telefono', '$email', '$password', '$tipo', 1)";
        $insertar = mysqli_query($con, $sql);

        $usuario2 = $_SESSION['usuario']['loginU'];
        $operacion = 'Registro del usuario '.$usuario;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql2 = "INSERT INTO AUDITORIA VALUES(null, '$usuario2', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql2);

        if($insertar){
            $_SESSION['completado'] = "El registro se ha insertado con exito";

            header('Location: ../usuarios.php');
        }else{
            echo '<h1>Algo malo sucedio!!!!!!</h1>';
            var_dump(mysqli_error($con));
            die();

        }

    }else{
        echo '<h1>Algo extraño sucedio!!!!!!</h1>';
    }

    


?>