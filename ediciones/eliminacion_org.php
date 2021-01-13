<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitEliminar'])){
        $idOrganizacion = $_SESSION['organizacion'];
        $sqlO = "UPDATE ORGANIZACION SET estadoOr = 0 where idOrganizacion = $idOrganizacion";
        $guardar = mysqli_query($con, $sqlO);
        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }

?>