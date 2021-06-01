<?php
namespace Clases;
use PDO;
use PDOException;

class Hoteles extends Conexion {
    private $id, $nombre, $localidad, $direccion;


    public function __construct()
    {
        parent::__construct();
    }

    //Crud-----------------------------------------------
    public function create() {
        $c = "insert into hoteles(nombre, localidad, direccion) values(:n, :l, :d)";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute([
                    ':n'=>$this->nombre,
                    ':l'=>$this->localidad,
                    ':d'=>$this->direccion
                ]);
            } catch (PDOException $ex) {
                die("Error al insertar en Hoteles: " .$ex->getMessage());
            }
    }
    public function read($id) {
        $c = "select * from hoteles where id = :i";
            $stmt=parent::$conexion->prepare($c);
            try {
                $stmt->execute([
                    ':i'=>$id,
                ]);
            } catch (PDOException $ex) {
                die("Error al recuperar los hoteles, ".$ex->getMessage());
            }
            $fila = $stmt->fetch(PDO::FETCH_OBJ);
            return $fila;
    }
    public function update(){
        $u = "update hoteles set nombre=:n, localidad=:l, direccion=:d where id=:i";
            $stmt = parent::$conexion->prepare($u);

            try {
                $stmt->execute([
                    ':n'=>$this->nombre,
                    ':d'=>$this->direccion,
                    ':l'=>$this->localidad,
                    ':i'=>$this->id
                ]);
            } catch (PDOException $ex) {
                die("Error al actualizar en clientes: " .$ex->getMessage());
            }
    }
    public function delete()
    {
        $c = "delete from hoteles where id=:i";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute([
                    ':i'=>$this->id
                ]);
            } catch (PDOException $ex) {
                die("Error al borrar el hotel, ".$ex->getMessage());
            }
    }

    public function deleteAll() {
        $c = "delete from hoteles";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die("Error al borrar Hoteles: " .$ex->getMessage());
            }
    }

    public function getTodos()
        {
            $c = "select * from hoteles order by localidad, nombre";
            $stmt = parent::$conexion->prepare($c);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die("Error al devolver hoteles, ".$ex->getMessage());
            }
            return $stmt;
        }

        public function existeNombre($m)
        {
            $c = "select * from hoteles where nombre=:m";
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

        public function existeNombreU($m, $id)
        {
            $c = "select * from hoteles where nombre=:m AND id!=:i";
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
     * Get the value of localidad
     */ 
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set the value of localidad
     *
     * @return  self
     */ 
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }
}