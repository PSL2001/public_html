<?php
    namespace Clases;

use PDO;
use PDOException;

class Conexion{
        protected static $conexion;
        
        public function __construct()
        {
            if (self::$conexion==null) {
                self::crearConexion();
            }
        }

        public static function crearConexion()
        {
            //1. - Leemos config
            $opciones = parse_ini_file(dirname(__DIR__)."/.config");
            $base = $opciones['database'];
            $user = $opciones['user'];
            $pass = $opciones['pass'];
            $host = $opciones['host'];
            //2. - Creamos el dns
            $dns = "mysql:host=$host;dbname=$base;charset=utf8mb4";
            //3. - Creo la conexion
            try {
                self::$conexion = new PDO($dns, $user, $pass);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                die("Error al conectar con la base de datos: " .$ex->getMessage());
            }
        }
    }