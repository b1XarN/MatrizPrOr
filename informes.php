<?php 
    require_once 'conexion.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://kit.fontawesome.com/496cc02742.js" crossorigin="anonymous"></script>        
    <title>Menu Principal</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4 side">
                <div class="mt-2" style="text-align:center;padding: 15px 20px 0px 20px; color: #fff; font-size:25px;">
                    <i class="far fa-user" style="font-size:50px; margin-bottom:10px;"></i>
                    <p><?=$_SESSION['usuario']['loginU']?></p>
                </div>
                <div>
                    <a href="perfil.php" class="links-side">Mi Perfil</a>
                    <a href="menu.php" class="links-side">Empresas</a>
                    <?php 
                        if($_SESSION['usuario']['tipo'] == 'Administrador'){
                        ?>
                            <a href="usuarios.php" class="links-side">Administrar Usuarios</a>
                        <?php 
                        }
                    ?>
                    <?php  
                        if($_SESSION['usuario']['tipo'] == 'Administrador' || $_SESSION['usuario']['tipo'] == 'Auditor'){
                        ?>
                            <a href="auditoria.php" class="links-side">Auditoria</a>
                        <?php 
                        }
                    ?>
                    <a href="salir.php" class="links-side">Salir</a>
                </div>  
            </div>

            <div class="col-8 contenido">
                <?php  
                    $sqlE = "SELECT * FROM EMPRESA where idEmpresa = $_GET[id]";
                    $empresas = mysqli_query($con, $sqlE);
                    $empresa = mysqli_fetch_assoc($empresas);
                ?>
                <h2>Informes: <?=$empresa['nombreEmpresa']?></h2>
                <hr>


                <?php  
                    $sqlsP = "SELECT * FROM SUBPROCESO where idEmpresa = $_GET[id] and estadoSub = 1";
                    $subprocesos = mysqli_query($con, $sqlsP);



                ?>

                <h4>Procesos sin areas u organizacion responsable</h4>
                <ul>
                        <?php  
                            
                            while($subproceso = mysqli_fetch_assoc($subprocesos)):
                                $idSub = $subproceso['idSubProceso'];        
                                $sqlDA = "SELECT * FROM DETALLE_ASIGNACION WHERE idEmpresa = $_GET[id] and idSubProceso = $idSub";
                                $asignaciones = mysqli_query($con, $sqlDA);
                                $ver = false;
                                while($asignacion = mysqli_fetch_assoc($asignaciones)):
                                    if($asignacion['asignacion'] == 'Responsabilidad mayor'){
                                        $ver = true;
                                        break;
                                    }
                                endwhile;
                                if($ver == false){
                                ?>
                                    <li><?=$subproceso['nombreSub']?></li>
                                <?php 
                                }
                            endwhile;
                        ?>
                </ul>

                <h4>Areas u organizacion sin proceso responsable</h4>
                <ul>
                        <?php  
                            $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $_GET[id] and estadoOr = 1";
                            $organizaciones = mysqli_query($con, $sqlO);
                            
                            while($organizacion = mysqli_fetch_assoc($organizaciones)):
                                $idOr = $organizacion['idOrganizacion'];        
                                $sqlDA = "SELECT * FROM DETALLE_ASIGNACION WHERE idEmpresa = $_GET[id] and idOrganizacion = $idOr";
                                $asignaciones = mysqli_query($con, $sqlDA);
                                $ver = false;
                                while($asignacion = mysqli_fetch_assoc($asignaciones)):
                                    if($asignacion['asignacion'] == 'Responsabilidad mayor'){
                                        $ver = true;
                                        break;
                                    }
                                endwhile;
                                if($ver == false){
                                ?>
                                    <li><?=$organizacion['nombreOrganizacion']?></li>
                                <?php 
                                }
                            endwhile;
                        ?>
                </ul>

                <h4>Areas u organizacion sin proceso asignado</h4>
                <ul>
                        <?php  
                            $sqlO = "SELECT * FROM ORGANIZACION where idEmpresa = $_GET[id] and estadoOr = 1";
                            $organizaciones = mysqli_query($con, $sqlO);
                            
                            while($organizacion = mysqli_fetch_assoc($organizaciones)):
                                $idOr = $organizacion['idOrganizacion'];        
                                $sqlDA = "SELECT * FROM DETALLE_ASIGNACION WHERE idEmpresa = $_GET[id] and idOrganizacion = $idOr";
                                $asignaciones = mysqli_query($con, $sqlDA);
                                $ver = false;
                                while($asignacion = mysqli_fetch_assoc($asignaciones)):
                                    if($asignacion['asignacion'] == 'Responsabilidad mayor' || $asignacion['asignacion'] == 'Participacion mayor' || $asignacion['asignacion'] == 'Alguna participacion'){
                                        $ver = true;
                                        
                                    }
                                    
                                endwhile;
                                if($ver == false){
                                ?>
                                    <li><?=$organizacion['nombreOrganizacion']?></li>
                                <?php 
                                }
                            endwhile;
                        ?>
                </ul>
                <a href="menu.php" class="btn btn-outline-success">Volver</a>           
            </div>
        </div>

        


    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>