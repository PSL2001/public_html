<?php

namespace Clases;

use Clases\Conexion;
use PDOException;
use PDO;

class Post extends Conexion {
    private $id;
    private $titulo;
    private $cuerpo;
    private $idUser;
    private $fecha;

    public function __construct()
    {
        parent::__construct();
    }
    //---------------------Crud------------------------------------------------
    public function create() {
        $con = "insert into posts(titulo, cuerpo, idUser, fecha) values(:t, :c, :iu, now())";
        $stmt=parent::$conexion->prepare($con);

        try {
            $stmt->execute([
                ":t"=>$this->titulo,
                ':c'=>$this->cuerpo,
                ':iu'=>$this->idUser
            ]);
        } catch (PDOException $ex) {
            die("Error al insertar en post, ".$ex->getMessage());
        }
    }
    public function read() {

    }
    public function update() {

    }
    public function delete() {

    }

    //-------------------------------------------------------------------------

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
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of cuerpo
     */ 
    public function getCuerpo()
    {
        return $this->cuerpo;
    }

    /**
     * Set the value of cuerpo
     *
     * @return  self
     */ 
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}