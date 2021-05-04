<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
    die();
}
if (!isset($_GET['un'])) {
    header("location:post.php");
    die();
}
require '../vendor/autoload.php';

use Clases\Post;
$misPosts = new Post();
$datos = $misPosts->devolverPorUsuario($_GET['un']);
$misPosts = null;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>

<body style="background-color: bisque;">
    <?php
    require './resources/navbar.php';
    ?>
    <a href="crearPost.php" class="btn btn-primary my-3">Nuevo Post</a>
    <h3 class="text-center mt-3">Gestionar posts</h3>
    <div class="container mt-3">
        <?php
        require './resources/mensajes.php';
        ?>
        <table class="table table-success table-striped">
            <table class="table table">
                <thead>
                    <tr>
                        <th scope="col">Detalles</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Autor</th>
                        <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $datos->fetch(PDO::FETCH_OBJ)) {
                        echo "<tr>";
                        echo "<th scope='row'>";
                        echo "<a href='detallesPost.php?id={$fila->id}' class='btn btn-success'>Detalles</a></th>";
                        echo "<td>{$fila->titulo}</td>";
                        echo "<td>{$fila->username}</td>";
                        echo "<td>\n";
                        echo "<a href='editarPost.php?id={$fila->id}' class='btn btn-warning'>Editar</a>&nbsp;\n";
                        echo "</td>\n";
                        echo "<td>\n";
                        echo "<form name='as' method='POST' class='form-inline' action='borrarPost.php'>\n";
                        echo "<input type='hidden' name='codigo' value='{$fila->id}'>\n";
                        echo "<button type='submit' class='ml-2 btn btn-danger'>Borrar</button>";
                        echo "</form>\n";
                        echo "</td>\n";
                        echo "</tr>\n";
                    }
                    ?>

                </tbody>
            </table>
        </table>
    </div>
</body>

</html>