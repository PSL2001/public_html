<?php
    require '../vendor/autoload.php';
    use Clases\Datos;

    $nu=new Datos('users', 15);
    echo "<h3>Datos Usuarios Creados</h3>";
    $nt=new Datos('tags', 12);
    echo "<h3>Tags Creados</h3>";
    $post = new Datos('post', 40);
    echo "<h2>Post Creados</h2>";