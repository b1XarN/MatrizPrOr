<?php 

    if(isset($_POST['submitIngresar'])){

        require_once 'conexion.php';

        if(isset($_SESSION['error_login'])){
            unset($_SESSION['error_login']);
        }

        $usuario = $_POST['usuario'];
        $password = $_POST['contra'];

        $sql = "SELECT * FROM USUARIO WHERE loginU = '$usuario' AND contra = '$password'";
        $login = mysqli_query($con, $sql);

        if($login && mysqli_num_rows($login) == 1){
            $log = mysqli_fetch_assoc($login);
    
            $_SESSION['usuario'] = $log;

            var_dump($_SESSION['usuario']);
            
            

            header('Location: menu.php');

        }else{
            $_SESSION['error_login'] = "Login incorrecto";
            header('Location: index.php');
        }

    }else{
        $_SESSION['error_login'] = "Login incorrecto";
        header('Location: index.php');
    }
    
    

?>