<?php 
    require_once 'conexion.php';
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
        $sqlP = "SELECT * FROM PROCESO where idEmpresa = $_GET[id] and estadoProceso = 1";
        $sqlsP = "SELECT * FROM SUBPROCESO where idEmpresa = $_GET[id] and estadoSub = 1";
        $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $_GET[id] and estadoOr = 1";
        
        $empresas = mysqli_query($con, $sql);
        $procesos = mysqli_query($con, $sqlP);
        $subprocesos = mysqli_query($con, $sqlsP);
        $organizaciones = mysqli_query($con, $sqlO);


        $empresa = mysqli_fetch_assoc($empresas);
    ?>
    <div class="container">
        <div class="row">
            <div class="col" style="text-align:center">
                <h2>Editar Matriz: <?=$empresa['nombreEmpresa']?></h2>
            </div>
        </div>

        <div class="row my-5">
            <div class="col">
                <h3>Agregar Proceso</h3>
                <form action="registros/registrar_proceso.php?id=<?=$_GET['id']?>" method="POST">
                    <input type="text" name="proceso" required="required" minlength="3">
                    <input type="submit" name="submitProceso" value="Registrar" class="btn btn-primary">
                </form>
            </div>
            <div class="col">
                <h3>Agregar Organizacion</h3>
                <form action="registros/registrar_organizacion.php?id=<?=$_GET['id']?>" method="POST">
                    <input type="text" name="organizacion">
                    <input type="submit" name="submitOrganizacion" value="Registrar" class="btn btn-primary">
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <h3>Agregar SubProcesos</h3>
                <?php  
                    if(mysqli_num_rows($procesos) >= 1){
                        ?>
                        <form action="registros/registrar_subproceso.php?id=<?=$_GET['id']?>" method="POST">
                            <label for="">Seleccione un proceso</label><br>
                            <select name="procesos" id="">
                                <?php  
                                    while($proceso = mysqli_fetch_assoc($procesos)):
                                        ?>
                                            <option value="<?=$proceso['idProceso']?>"><?=$proceso['nombreProceso']?></option>
                                        <?php         
                                    endwhile;
                                ?>
                            </select><br>
                            <label for="">Ingrese subproceso</label><br>
                            <input type="text" name="subproceso" required="required" minlength="3">
                            <input type="submit" name="submitRegistrar" value="Registrar" class="btn btn-primary">
                        </form>
                        <?php  
                    }else{
                        echo '<h5>Debe de haber minimo un proceso registrado</h5>';
                    }
                ?>
            </div>
            
            <div class="col">
                <h3>Asignar SubProcesos</h3>
                <?php  
                    if(mysqli_num_rows($subprocesos)>=1 and mysqli_num_rows($organizaciones)>=1){
                        ?>
                            <form action="asignacion.php?id=<?=$_GET['id']?>" method="POST">
                                <label for="">Seleccione un subproceso</label><br>
                                <select name="subprocesos" id="">
                                    <?php  
                                        while($subproceso = mysqli_fetch_assoc($subprocesos)):
                                            ?>
                                                <option value="<?=$subproceso['idSubProceso']?>"><?=$subproceso['nombreSub']?></option>
                                            <?php         
                                        endwhile;
                                    ?>
                                </select>
                                <input type="submit" name="submitSeleccionar" value="Seleccionar" class="btn btn-primary">
                            </form>  
                        <?php 
                    }else{
                        echo '<h5>Debe de haber minimo un subproceso y organizacion registrados</h5>';
                    }
                ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <a href="empresa.php?id=<?=$_GET['id']?>" class="btn btn-danger">Salir</a>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
