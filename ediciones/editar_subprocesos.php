<?php  
    require_once '../conexion.php';
    if(isset($_POST['submitEditar']) || isset($_POST['submitEliminar'])){
        if(isset($_SESSION['subproceso'])){
            unset($_SESSION['subproceso']);
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
                    $idSubProceso = $_POST['subprocesos'];
                    $idEmpresa = $_GET['id'];
                    $sqlsP = "SELECT * FROM SUBPROCESO where idEmpresa = $idEmpresa and idSubProceso = $idSubProceso and estadoSub = 1";
                    $subprocesos = mysqli_query($con, $sqlsP);
                    $subproceso = mysqli_fetch_assoc($subprocesos);  
                    $_SESSION['subproceso'] = $subproceso['idSubProceso'];
                    if(isset($_POST['submitEditar'])){
                    ?>
                        <h2>Editar Subproceso: <?=$subproceso['nombreSub']?></h2>
                        <form action="edicion_sub.php?id=<?=$_GET['id']?>" method="POST">
                            <label for="">Ingrese nuevo nombre del subproceso</label>
                            <input type="text" name="nuevoSub" required="required" style="width:80%;"><br>
                            <input type="submit" name="submitActualizar" value="Actualizar" class="btn btn-primary">
                            <a href="../editar_matriz.php?id=<?=$_GET['id']?>" class="btn btn-danger my-3">Salir</a>
                        </form>

                    <?php 
                    }else{
                    ?>
                        <h2>Eliminar Subproceso</h2>
                        <h3>¿Seguro que desea eliminar el subproceso: <?=$subproceso['nombreSub']?>?</h3>
                        <form action="eliminacion_sub.php?id=<?=$_GET['id']?>" method="POST">
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