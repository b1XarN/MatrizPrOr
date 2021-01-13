<?php  
    require_once '../conexion.php';

    if(isset($_POST['submitActualizar'])){
        $nuevoOrg = $_POST['nuevoOrg'];
        $idOrg = $_SESSION['organizacion'];
        $sqlO = "UPDATE ORGANIZACION SET nombreOrganizacion = '$nuevoOrg' where idOrganizacion = $idOrg";
        $guardar = mysqli_query($con, $sqlO);
        header('Location: ../empresa.php?id='.$_GET['id']);        
    }else{
        echo 'ALGO SALIO MAAAAAL!!!!';
    }
?>