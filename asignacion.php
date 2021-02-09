<?php 
    require_once 'conexion.php';
    
    if(isset($_SESSION['subproceso'])){
        unset($_SESSION['subproceso']);
    }
    $_SESSION['subproceso'] = $_POST['subprocesos'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Editar Matriz</title>
</head>
<body>
    <?php 
        $sql = "SELECT * FROM EMPRESA where idEmpresa = $_GET[id]";
        $sqlP = "SELECT * FROM PROCESO where idEmpresa = $_GET[id]";
        $sqlsP = "SELECT * FROM SUBPROCESO where idEmpresa = $_GET[id] and idSubProceso = $_POST[subprocesos] and estadoSub = 1";
        $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $_GET[id] and estadoOr = 1";
        
        $empresas = mysqli_query($con, $sql);
        $procesos = mysqli_query($con, $sqlP);
        $subprocesos = mysqli_query($con, $sqlsP);
        $organizaciones = mysqli_query($con, $sqlO);

        $empresa = mysqli_fetch_assoc($empresas);
        $subproceso = mysqli_fetch_assoc($subprocesos);
    ?>
    <div class="container">
        <div class="row">
            <div class="col" style="text-align:center">
                <h2>Asignacion</h2>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <h3>Sub Proceso: <?=$subproceso['nombreSub']?></h3>
                   <form action="asignar.php?id=<?=$_GET['id']?>" method="POST">
                        <?php 
                            while($organizacion = mysqli_fetch_assoc($organizaciones)):
                                ?>
                                    <label for="" style="margin-right: 25px;"><?=$organizacion['nombreOrganizacion']?>: </label>
                                    <?php  
                                        $sqlDA = "SELECT * FROM DETALLE_ASIGNACION where idEmpresa = $_GET[id] and idSubProceso = $subproceso[idSubProceso] and idOrganizacion = $organizacion[idOrganizacion]";
                                        $asignaciones = mysqli_query($con, $sqlDA);
                                        while($asignacion = mysqli_fetch_assoc($asignaciones)):
                                            if($asignacion['asignacion'] == 'Responsabilidad mayor'){
                                                ?>
                                                <input type="radio" name="<?=$organizacion['nombreOrganizacion']?>" value="Responsabilidad mayor" checked> Responsabilidad mayor 
                                                <?php 
                                            }else{
                                                ?>
                                                <input type="radio" name="<?=$organizacion['nombreOrganizacion']?>" value="Responsabilidad mayor"> Responsabilidad mayor     
                                                <?php
                                            }

                                            if($asignacion['asignacion'] == 'Participacion mayor'){
                                                ?>
                                                <input type="radio" name="<?=$organizacion['nombreOrganizacion']?>" value="Participacion mayor" checked> Participacion mayor 
                                                <?php
                                            }else{
                                                ?>
                                                <input type="radio" name="<?=$organizacion['nombreOrganizacion']?>" value="Participacion mayor"> Participacion mayor                                                 
                                                <?php
                                            }

                                            if($asignacion['asignacion'] == 'Alguna participacion'){
                                                ?>
                                                <input type="radio" name="<?=$organizacion['nombreOrganizacion']?>" value="Alguna participacion" checked> Alguna participacion 
                                                <?php 
                                            }else{
                                                ?>
                                                <input type="radio" name="<?=$organizacion['nombreOrganizacion']?>" value="Alguna participacion"> Alguna participacion 
                                                <?php 
                                            }
                                            if($asignacion['asignacion'] == 'Sin participacion'){
                                                ?>
                                                <input type="radio" name="<?=$organizacion['nombreOrganizacion']?>" value="Sin participacion" checked> Sin participacion <br>
                                                <?php 
                                            }else{
                                                ?>
                                                <input type="radio" name="<?=$organizacion['nombreOrganizacion']?>" value="Sin participacion" > Sin participacion <br>
                                                <?php 
                                            }
                                    ?>
                                <?php 
                                        endwhile;
                            endwhile;
                        ?>
                        <div style="text-align: center;">
                            <input type="submit" name="submitAsignar" value="Asignar" class="btn btn-primary" >
                            <a href="empresa.php?id=<?=$_GET['id']?>" class="btn btn-danger" >Salir</a>
                        </div>
                   </form> 
            </div>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
