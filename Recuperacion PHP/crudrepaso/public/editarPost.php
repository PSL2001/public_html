<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
    }
    if (!isset($_GET['id'])) {
        header("location:post.php");
        die();
    }
    require '../vendor/autoload.php';
    use Clases\{Conexion, Post, Tags, PostTemas, Users};
    //recupero El idPost que quiero actualizar
    $idPost=$_GET['id'];


    $cat = new Tags();
    $todas = $cat->devolverTodo();
    $cat = null;

    $catPost = new PostTemas();
    $catSelec = $catPost->tagPorpost($idPost);
    $catPost = null;

    $estePost = new Post();
    $estePost->setId($idPost);
    $datos=$estePost->devolverPost();

    function errores($texto) {
        $_SESSION['mensaje'] = $texto;
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }

    if (isset($_POST['crear'])) {
        //1.- Recupero el Id del usuario con el que estamos logueados a partir de su nombre
        $usuario = new Users();
        $idU = $usuario->devolverIdUser($_SESSION['username']);
        $usuario = null;
        //2. - Recupero y limpio titulo y cuerpo
        $titulo = ucwords(trim($_POST['titulo']));
        $contenido = ucfirst(trim($_POST['cuerpo']));
        if (strlen($titulo)==0 || strlen($contenido)==0) {
            errores("Rellena titulo y contenido");
        }
        //3. - Compruebo que al menos he elegido una categoria
        if (!is_array($_POST['categorias'])) {
            errores("Selecciona al menos 1 categoria");
        }
        //4. - Guardamos el post (tit, cuerpo, idU)
        $nuevoPost = new Post();
        $nuevoPost->setTitulo($titulo);
        $nuevoPost->setCuerpo($contenido);
        $nuevoPost->setIdUser($idU);
        $nuevoPost->create();
        //5. - Ahora con el post creado le iremos añadiendo las etiquetas
        // Seleccionadas (al menos hemos obligado a que haya 1)
        $id_Post = Conexion::getConexion()->lastInsertId();
        // recorremos las categorias seleccionadas
        $pt = new PostTemas();
        $pt->setIdPost($id_Post);
        foreach ($_POST['categorias'] as $item => $value) {
            $pt->setIdTags($value);
            $pt->create();
        }
        $nuevoPost= null;
        $pt = null;
        $_SESSION['mensaje'] = "Post creado con exito";
        header("Location:post.php");
    } else {
        # pintamos el form
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Post</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body style="background-color: bisque;">
<?php
    require 'resources/navbar.php';
?>
    <h3 class="text-center mt-3">Crear Post</h3>
    <div class="container mt-3">
    <?php
        require 'resources/mensajes.php';
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="mt-2">
        <input type="text" name="titulo" value="<?php echo $datos->titulo; ?>" required>
    </div>
    <div class="mt-2">
    <textarea class="form-control" name="cuerpo"><?php echo $datos->cuerpo; ?></textarea>
    </div>
    <div class="mt-2">
    <ul>
    <?php
    while ($item=$todas->fetch(PDO::FETCH_OBJ)) {
        echo "<li>\n";
        if (in_array($item->id, $catSelec)) {
            echo "<input type='checkbox' name='categorias[]' value='{$item->id}' checked >&nbsp; {$item->categoria}";
        } else {
            echo "<input type='checkbox' name='categorias[]' value='{$item->id}'>&nbsp; {$item->categoria}";
        }
        echo "</li>\n";
        
    }
    ?>
    </ul>
    </div>
    <div class="mt-2">
        <input type="submit" name="crear" value="Crear" class="btn btn-success mr-2">
        <input type="reset" value="Limpiar" class="btn btn-warning mr-2">
        <a href="post.php" class="btn btn-primary">Volver</a>
    </div>
    </form>
    </div>
</body>
</html>
<?php } ?>