<?php
    require_once '../conexion.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="https://kit.fontawesome.com/496cc02742.js" crossorigin="anonymous"></script>
    <title>Menu Principal</title>
</head>
<body>
    <?php 
        $sql = "SELECT * FROM EMPRESA WHERE idEmpresa=$_GET[id]";

        $empresas = mysqli_query($con, $sql);

        $empresa = mysqli_fetch_assoc($empresas);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-4 side">
                <div class="mt-2" style="text-align:center;padding: 15px 20px 0px 20px; color: #fff; font-size:25px;">
                    <div class="mt-2">
                        <p>USUARIO</p>
                    </div>
                </div>
                
            </div>
            <div style="text-align: center" class="col-8 contenido">
                <h3 class="mb-3 mt-5">¿Seguro que desea eliminar la empresa?</h3>
                <p style="font-size:25px;">Empresa: <?=$empresa['nombreEmpresa']?></p>
                <p style="font-size:20px;">RUC: <?=$empresa['RUC']?></p>
                <a href="eliminar.php?id=<?=$_GET['id']?>" class="btn btn-outline-danger">Si</a>
                <a href="../menu.php" class="btn btn-outline-primary">No</a>
            </div>
        </div>



    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>