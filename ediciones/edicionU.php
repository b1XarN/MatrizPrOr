<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitActualizar'])){
        var_dump($_POST);
        
        $sql1 = "SELECT * FROM USUARIO WHERE loginU = '$_GET[id]'";

        $usuarios = mysqli_query($con, $sql1);

        $usuario = mysqli_fetch_assoc($usuarios);

        var_dump($usuario);

        $Login = $usuario['loginU'];
        $nuevoNombre = $usuario['nombresApellidos'];
        $nuevoDNI = $usuario['DNI'];
        $nuevaDireccion = $_POST['direccion'];
        $nuevoTelefono = $_POST['telefono'];
        $nuevoCorreo = $_POST['correo'];
        $nuevaContra = $_POST['contrasena'];
        $nuevoTipo = $_POST['tipo'];

        echo "$Login \n";
        echo "$nuevoNombre \n";
        echo "$nuevoDNI \n";
        echo "$nuevaDireccion \n";
        echo "$nuevoTelefono \n";
        echo "$nuevoCorreo \n";
        echo "$nuevaContra \n";
        echo "$nuevoTipo \n";

        $sql2 = "UPDATE USUARIO SET direccion = '$nuevaDireccion', telefono = $nuevoTelefono, correo = '$nuevoCorreo', contra = '$nuevaContra', tipo = '$nuevoTipo' WHERE loginU = '$Login'";

        $actualizar = mysqli_query($con, $sql2);

        $usu = $_SESSION['usuario']['loginU'];
        $operacion = 'Edito los datos del usuario '.$Login;
        $hoy = date('l jS \of F Y h:i:s A');
        $sql3 = "INSERT INTO AUDITORIA VALUES(null, '$usu', '$operacion', '$hoy')";
        $guardar2 = mysqli_query($con, $sql3);


        header('Location: ../usuarios.php');

        
        
    }else{
        echo 'ALGO SALIO MAL!!!!!!';
    }

?>