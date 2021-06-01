<?php
if (!isset($_POST['id'])) {
    header("location:index.php");
    die();
}
$id = $_POST['id'];

session_start();

require_once dirname(__DIR__, 2) . "/vendor/autoload.php";
use Clases\Hoteles;
$cli = new Hoteles();;
$cli->setId($id);
$cli->delete();
$cli=null;
$_SESSION['mensaje'] = "Hotel borrado";
header("location:index.php");