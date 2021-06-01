<?php
    namespace Clases;

use PDO;
use PDOException;

class Clientes extends Conexion {
        private $id, $nombre, $apellidos, $email;

        public function __construct()
        {
            parent::__construct();
        }

        //CRUD----------------------------------------------
        public function create() {
            $c = "insert into clientes(apellidos, nombre, email) values(:a, :n, :e)";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute([
                    ':a'=>$this->apellidos,
                    ':n'=>$this->nombre,
                    ':e'=>$this->email
                ]);
            } catch (PDOException $ex) {
                die("Error al insertar en clientes: " .$ex->getMessage());
            }
        }
        public function read($id) {
            $c = "select * from clientes where id = :i";
            $stmt=parent::$conexion->prepare($c);
            try {
                $stmt->execute([
                    ':i'=>$id,
                ]);
            } catch (PDOException $ex) {
                die("Error al recuperar los clientes, ".$ex->getMessage());
            }
            $fila = $stmt->fetch(PDO::FETCH_OBJ);
            return $fila;
        }
        public function update() {
            $u = "update clientes set nombre=:n, apellidos=:a, email=:m where id=:i";
            $stmt = parent::$conexion->prepare($u);

            try {
                $stmt->execute([
                    ':a'=>$this->apellidos,
                    ':n'=>$this->nombre,
                    ':m'=>$this->email,
                    ':i'=>$this->id
                ]);
            } catch (PDOException $ex) {
                die("Error al actualizar en clientes: " .$ex->getMessage());
            }
        }
        public function delete() {
            $c = "delete from clientes where id=:i";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute([
                    ':i'=>$this->id
                ]);
            } catch (PDOException $ex) {
                die("Error al borrar el cliente, ".$ex->getMessage());
            }
        }
        //----------------------------------------------------
        public function getTodos()
        {
            $c = "select * from clientes order by apellidos";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die("Error al devolver clientes, ".$ex->getMessage());
            }
            return $stmt;
        }

        public function existeEmail($m)
        {
            $c = "select * from clientes where email=:m";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute([
                    ':m'=>$m
                ]);
            } catch (PDOException $ex) {
                die("No se que has hecho pero ha petado");
            }
            $fila = $stmt->fetch(PDO::FETCH_OBJ);
            return ($fila) ? true: false;
        }
        //--------------------------------------------------
        public function existeEmailU($m, $id)
        {
            $c = "select * from clientes where email=:m AND id!=:i";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute([
                    ':m'=>$m,
                    ':i'=>$id
                ]);
            } catch (PDOException $ex) {
                die("No se que has hecho pero ha petado");
            }
            $fila = $stmt->fetch(PDO::FETCH_OBJ);
            return ($fila) ? true: false;
        }
        //----------------------------------------------------

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellidos
         */ 
        public function getApellidos()
        {
                return $this->apellidos;
        }

        /**
         * Set the value of apellidos
         *
         * @return  self
         */ 
        public function setApellidos($apellidos)
        {
                $this->apellidos = $apellidos;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        //Los metodos chachipistachis
        public function hayClientes() {
            $c="select * from clientes";
            $stmt=parent::$conexion->prepare($c);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die("ERROR");
            }
            //Si el $stmt = null entonces devuelvo true, falso si es el caso contrario
            $datos = $stmt->fetch(PDO::FETCH_OBJ);
            return ($datos==null) ? false: true;
        }
    }