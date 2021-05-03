<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location:login");
        die();
    }
    if (!isset($_POST['codigo'])) {
        header("Location:post.php");
    }
    require '../vendor/autoload.php';

    use Clases\Post;
    $estePost = new Post();
    $estePost->setId($_POST['codigo']);
    $estePost->delete();
    $estePost=null;
    $_SESSION['mensaje']="Post Borrado Correctamente";
    header("Location:post.php");