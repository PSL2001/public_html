<?php
require dirname(__DIR__)."/vendor/autoload.php";
use Clases\Datos;
$cliente = new Datos('clientes', 50);
echo "<h2>Clientes creados</h2>";
$hoteles = new Datos('hoteles', 10);
echo "<h2>Hoteles creados</h2>";