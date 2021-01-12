<?php
    require_once 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="https://kit.fontawesome.com/496cc02742.js" crossorigin="anonymous"></script>
    <title>Nueva Empresa</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4 side">
               <p>USUARIOS</p>
            </div>
            <div class="col-8 contenido">
                <h2>Nueva Empresa</h2>
                <hr>
                <div>
                    <form action="registro_emp.php" method="POST">
                        <label for="">Nombre Empresa</label><br>
                        <input type="text" style="width: 90%;" name="nombreEmpresa" required="required"><br>
                        <label for="">RUC</label><br>
                        <input type="text" style="width: 90%;" name="ruc" pattern="[0-9]+" maxlength="11" minlength="11" required="required"><br>
                        <label for="">Mision</label><br>
                        <textarea name="mision" style="width: 90%;" id="" cols="30" rows="5" required="required"></textarea><br>
                        <label for="">Vision</label><br>
                        <textarea name="vision" style="width: 90%;" id="" cols="30" rows="5" required="required"></textarea><br>
                        <label for="">Propuesta de valor</label><br>
                        <textarea name="valor" style="width: 90%;" id="" cols="30" rows="5" required="required"></textarea><br>
                        <label for="">Factor diferenciador</label><br>
                        <textarea name="factor" style="width: 90%;" id="" cols="30" rows="5" required="required"></textarea><br>
                        <label for="">Objetivos Estrategicos</label><br>
                        <textarea name="objetivos" style="width: 90%;" id="" cols="30" rows="5" required="required"></textarea><br>
                        <div style="text-align: right;" class="my-3">
                            <input type="submit" name="submitEmpresa" value="Guardar" class="btn btn-primary">
                            <a href="menu.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
