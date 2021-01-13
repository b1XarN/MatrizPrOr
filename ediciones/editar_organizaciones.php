<?php  
    require_once '../conexion.php';
    if(isset($_POST['submitEditar']) || isset($_POST['submitEliminar'])){
        if(isset($_SESSION['organizacion'])){
            unset($_SESSION['organizacion']);
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Edicion o Eliminacion de Subprocesos</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                    $idOrganizacion = $_POST['organizaciones'];
                    $idEmpresa = $_GET['id'];
                    $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $idEmpresa and idOrganizacion = $idOrganizacion and estadoOr = 1";
                    $organizaciones = mysqli_query($con, $sqlO);
                    $organizacion = mysqli_fetch_assoc($organizaciones);  
                    $_SESSION['organizacion'] = $organizacion['idOrganizacion'];
                    if(isset($_POST['submitEditar'])){
                    ?>
                        <h2>Editar Organizacion: <?=$organizacion['nombreOrganizacion']?></h2>
                        <form action="edicion_org.php?id=<?=$_GET['id']?>" method="POST">
                            <label for="">Ingrese nuevo nombre de la organizacion</label>
                            <input type="text" name="nuevoOrg" required="required" style="width:80%;"><br>
                            <input type="submit" name="submitActualizar" value="Actualizar" class="btn btn-primary">
                            <a href="../editar_matriz.php?id=<?=$_GET['id']?>" class="btn btn-danger my-3">Salir</a>
                        </form>

                    <?php 
                    }else{
                    ?>
                        <h2>Eliminar Organizacion</h2>
                        <h3>¿Seguro que desea eliminar la organizacion: <?=$organizacion['nombreOrganizacion']?>?</h3>
                        <form action="eliminacion_org.php?id=<?=$_GET['id']?>" method="POST">
                            <input type="submit" name="submitEliminar" value="Si" class="btn btn-danger">
                            <a href="../editar_matriz.php?id=<?=$_GET['id']?>" class="btn btn-primary">No</a>
                        </form>
                        
                    <?php 
                    }
                ?>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
<?php 
    }
    else{
        echo 'ALGO SALIO MAAAAL!!!';
    }
?>