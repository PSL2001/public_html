<?php
require '../vendor/autoload.php';
use Clases\Datos;
$cliente = new Datos('clientes', 50);
echo "<h2>Clientes creados</h2>";