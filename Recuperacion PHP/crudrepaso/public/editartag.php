<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
    }
    if (!isset($_GET['id'])) {
        header("Location:tags.php");
        die();
    }
    require '../vendor/autoload.php';
    use Clases\Tags;
    $id=$_GET['id'];
    $esteTag = new Tags();
    $esteTag->setId($id);
    $estaCat=$esteTag->read();
    

    if (isset($_POST['editar'])) {
        //procesamos el form
        $categoria=trim($_POST['categoria']);
        if (strlen($categoria)==0) {
            $_SESSION['mensaje'] = "Rellene el campo";
            //No olvidar el id pasado por GET 
            header("Location:{$_SERVER['PHP_SELF']}?id=$id");
            die();
        }
        //El campo es correcto, sigamos
        //Compruebo que el usuario ha cambiado la categoria
        if ($estaCat==ucwords($categoria)) {
            $esteTag=null;
            $_SESSION['mensaje']="Tag actualizado";
            header("Location:tags.php");
            die();
        }
        
        if (!$esteTag->existeTag(ucwords($categoria))) {
            $esteTag->setCategoria(ucwords($categoria));
            $esteTag->update();
            $esteTag=null;
            $_SESSION['mensaje']="Tag actualizado";
            header("Location:tags.php");
        } else {
            $_SESSION['mensaje']="Este tag ya existe";
            $esteTag = null;
            header("Location:{$_SERVER['PHP_SELF']}?id=$id");
            die();
        }
        
    } else {
        # pintamos el form
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tag</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body style="background-color: bisque;">
<?php
    require 'resources/navbar.php';
?>
    <h3 class="text-center mt-3">Editar tag</h3>
    <div class="container mt-3">
    <?php
        require 'resources/mensajes.php';
    ?>
    <!-- Ojo hay que poner en el action la variable por GET de la id -->
    <form action="<?php echo $_SERVER['PHP_SELF']."?id=$id"; ?>" method="post">
    <div class="mt-2">
        <input type="text" name="categoria" value="<?php echo $estaCat; ?>" required>
    </div>
    <div class="mt-2">
        <input type="submit" name="editar" value="Editar" class="btn btn-success mr-2">
        <input type="reset" value="Limpiar" class="btn btn-warning mr-2">
        <a href="tags.php" class="btn btn-primary">Volver</a>
    </div>
    </form>
    </div>
</body>
</html>
<?php } ?>