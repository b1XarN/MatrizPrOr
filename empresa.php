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
    <title>Vista de Empresas</title>
</head>
<body>
    <?php 
        $sql1 = "SELECT * FROM EMPRESA where idEmpresa = $_GET[id]";
        $sqlP = "SELECT * FROM PROCESO where idEmpresa = $_GET[id] and estadoProceso = 1";
        $sqlsP = "SELECT * FROM SUBPROCESO where idEmpresa = $_GET[id] and estadoSub = 1";
        $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $_GET[id] and estadoOr = 1";
        
        $empresas = mysqli_query($con, $sql1);
        $procesos = mysqli_query($con, $sqlP);
        $subprocesos = mysqli_query($con, $sqlsP);
        $organizaciones = mysqli_query($con, $sqlO);
        

        $empresa = mysqli_fetch_assoc($empresas);

    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 style="text-align:center"><?=$empresa['nombreEmpresa']?></h2>
            </div>
            <div class="col-12">
                <h3>Mision</h3>
                <p><?=$empresa['mision']?></p>
                <h3>Vision</h3>
                <p><?=$empresa['vision']?></p>
                <h3>Propuesta de Valor</h3>
                <p><?=$empresa['propuestaValor']?></p>
                <h3>Factor diferenciador</h3>
                <p><?=$empresa['factorDiferenciador']?></p>
                <h3>Objetivos Estrategicos</h3>
                <p><?=$empresa['objetivo']?></p>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-12">
                <a href="ediciones/editar_datos.php?id=<?=$_GET['id']?>" class="btn btn-success">Editar Datos</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                
                <?php  
                    if(mysqli_num_rows($procesos)>=1 and mysqli_num_rows($subprocesos)>=1 and mysqli_num_rows($organizaciones)>=1)
                    {
                    ?>         
                    <table class="table table-bordered" id="tablaPrOr">
                        <?php 
                            $filas = mysqli_num_rows($procesos) + mysqli_num_rows($subprocesos);
                            for($i =1 ; $i<= $filas; $i++){
                                while($proceso = mysqli_fetch_assoc($procesos)):
                                    $ver = true;
                                    if($ver == true){
                                    ?>
                                        <tr>
                                            <th>
                                                <?=$proceso['nombreProceso']?>
                                            </th>
                                            <?php 
                                                while($organizacion = mysqli_fetch_assoc($organizaciones)):
                                            ?>
                                            <th>
                                                <?=$organizacion['nombreOrganizacion']?>
                                            </th>
                                            <?php 
                                                endwhile;
                                                $ver=false;
                                            ?>
                                        </tr>
                                    <?php
                                    }
                                    if($ver == false){
                                        $proc = $proceso['idProceso'];
                                        $sqlsP2 = "SELECT * FROM SUBPROCESO where idEmpresa = $_GET[id] and idProceso = $proc and estadoSub = 1";
                                        $subs = mysqli_query($con, $sqlsP2);
                                        while($sub = mysqli_fetch_assoc($subs)):
                                        ?>
                                            <tr>
                                                <td>
                                                    <?=$sub['nombreSub']?>
                                                </td>
                                                <?php 
                                                    $organizaciones2 = mysqli_query($con, $sqlO);
                                                    while($organizacion2 = mysqli_fetch_assoc($organizaciones2)):
                                                        $org = $organizacion2['idOrganizacion'];
                                                        $sub2 = $sub['idSubProceso'];
                                                        $sqlasig = "SELECT * FROM DETALLE_ASIGNACION where idOrganizacion = $org and idSubProceso = $sub2 and idEmpresa = $_GET[id]";
                                                        $asignaciones = mysqli_query($con,$sqlasig);
                                                        $asignacion = mysqli_fetch_assoc($asignaciones);
                                                ?>

                                                    <td>
                                                        <?php 
                                                            if(mysqli_num_rows($asignaciones) == 0){
                                                                echo '';
                                                            }
                                                            else{
                                                                switch($asignacion['asignacion']){
                                                                    case 'Responsabilidad mayor':
                                                                        echo '<p style="font-size: 25px; font-weight: bold; text-align: center; color: red">X</p>';
                                                                        break;
                                                                    case 'Participacion mayor':
                                                                        echo '<p style="font-size: 20px; font-weight: light; text-align: center; color: red">X</p>';
                                                                        break;
                                                                    case 'Alguna participacion':
                                                                        echo '<p style="font-size: 20px; font-weight: light; text-align: center; color: red">/</p>';
                                                                        break;
                                                                    case 'Sin participacion';
                                                                        echo '';
                                                                        break;
                                                                    default:
                                                                        echo '';
                                                                        break;
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                <?php 
                                                    endwhile;
                                                    $ver=true;
                                                ?>
                                                
                                            </tr>
                                    <?php
                                        endwhile;
                                        
                                        }
                                endwhile; 
                            }
                        ?>      
                    </table>
                    <?php  
                    }else{
                        echo '<h2>Debe de existir minimo un subproceso y una organizacion</h2>';
                    }
                ?>
                
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-4">
                <?php  
                    if(mysqli_num_rows($procesos)>=1 and mysqli_num_rows($subprocesos)>=1 and mysqli_num_rows($organizaciones)>=1){
                        ?>
                        <button class="btn btn-danger" id="pdf">Exportar a PDF</button>
                        <button class="btn btn-primary" id="word">Exportar a Word</button>
                        <?php  
                    }else{

                    }
                ?>
            </div>
            <?php  
                if($_SESSION['usuario']['tipo'] == 'Administrador' || $_SESSION['usuario']['tipo'] == 'Normal'){
                ?>
                    <div class="col-4">
                        <a href="editar_matriz.php?id=<?=$_GET['id']?>" class="btn btn-success">Editar Matriz</a>
                    </div>
                <?php 
                }
            ?>
        </div>

        <div class="row justify-content-end mt-2">
            <div class="col-4">
                <a href="menu.php" class="btn btn-warning">Regresar</a>
            </div>
        </div>
        
    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript" src="js/tableExport.js"></script>
    <script type="text/javascript" src="js/jquery.base64.js"></script>
    <script type="text/javascript" src="js/exportarWord.js"></script>
    <script type="text/javascript" src="js/exportarPDF.js"></script>
</body>
</html>