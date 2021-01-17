<?php 
    require_once '../conexion.php';

    if(isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == 'Administrador' && isset($_GET['id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos.css">
    <title>Editar Usuario</title>
</head>
<body>
    <?php 
        $sql = "SELECT * FROM USUARIO WHERE loginU = '$_GET[id]'";

        $usuarios = mysqli_query($con,$sql);

        $usuario = mysqli_fetch_assoc($usuarios);

    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 my-3">
                <h2 style="text-align:center">Editar Usuario: <?=$usuario['loginU']?></h2>
            </div>
            <div class="col-8">
                <div class="">
                    <form action="edicionU.php?id=<?=$_GET['id']?>" method="POST">
                        <div class="row justify-content-center" style="">
                            <div class="col-6 mb-3">
                                <label for="">Nombres y Apellidos</label><br>
                                <input type="text" style="width: 80%;" name="nombresApellidos" value="<?=$usuario['nombresApellidos']?>" disabled="disabled"><br>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">DNI</label><br>
                                <input type="text" style="width: 80%;" name="dni" value="<?=$usuario['DNI']?>" disabled><br>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Direccion</label><br>
                                <input type="text" style="width: 80%;" name="direccion" value="<?=$usuario['direccion']?>" required="required"><br>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Telefono</label><br>
                                <input type="text" style="width: 80%;" name="telefono" value="<?=$usuario['telefono']?>" pattern="[0-9]+" required="required"><br>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="">Correo</label><br>
                                <input type="email" style="width: 38.5%;" name="correo" value="<?=$usuario['correo']?>" required="required"><br>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Usuario</label><br>
                                <input type="text" style="width: 80%;" name="usuario" value="<?=$usuario['loginU']?>" disabled><br>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Contraseña</label><br>
                                <input type="text" style="width: 80%;" name="contrasena" value="<?=$usuario['contra']?>" ><br>
                            </div>
                            <?php  
                                if($usuario['tipo'] == 'Administrador'){
                                    ?>
                                    <div class="col-12 mb-3" style="text-align:center">
                                        <label for="">Tipo</label>
                                        <select name="tipo" id="" class="mb-3">
                                            <option value="Administrador">Administrador</option>
                                        </select><br>
                                    </div>
                                    <?php 
                                }else{
                                    ?>
                                    <div class="col-12 mb-3" style="text-align:center">
                                        <label for="">Tipo</label>
                                        <select name="tipo" id="" class="mb-3">
                                            <option value="Normal">Normal</option>
                                            <option value="Auditor">Auditor</option>
                                            <option value="Administrador">Administrador</option>
                                        </select><br>
                                    </div>
                                <?php 
                                }
                            ?>
                            <div class="col-12 mb-5" style="text-align:center">
                                <input type="submit" name="submitActualizar" value="Actualizar" class="btn btn-primary">
                                <a href="../usuarios.php" class="btn btn-danger">Salir</a>
                            </div>
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
<?php
}else{
    echo 'ALGO SALIO MAAAAL!!';
} 
?>