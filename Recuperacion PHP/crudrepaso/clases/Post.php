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
        $con = "select distinct posts.*, tags.*, users.* from posts, users, tags, poststemas  
        where posts.id=:ip AND posts.idUser=users.id AND posts.id=poststemas.idPost AND 
        tags.id=poststemas.idTag";

        $stmt=parent::$conexion->prepare($con);

        try {
            $stmt->execute([
                ':ip'=>$this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al leer el post, ".$ex->getMessage());
        }
        return $stmt;
    }
    public function update() {

    }
    public function delete() {
        $con = "delete from posts where id=:i";
        $stmt = parent::$conexion->prepare($con);

        try {
            $stmt->execute([
                ':i'=>$this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al borrar post ".$ex->getMessage());
        }
    }
    public function borrarTodo() {
        $con = "delete from posts";
        $stmt = parent::$conexion->prepare($con);

        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al borrar los posts ".$ex->getMessage());
        }
    }

    public function devolverTodo(){
        $con="select posts.*,username from posts, users 
        where posts.idUser=users.id order by username,titulo";
        $stmt=parent::$conexion->prepare($con);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al devolver los posts. Mensaje:".$ex->getMessage());
        }
        return $stmt;
    }
    public function devolverPost(){
        $con="select * from posts where id=:i";
        $stmt=parent::$conexion->prepare($con);
        try{
            $stmt->execute([
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al devolver TODOS los posts. Mensaje:".$ex->getMessage());
        }
        return ($stmt->fetch(PDO::FETCH_OBJ));
    }

    public function devolverPorCategoria() {
        $con="select posts.*,username from posts, users, tags, poststemas
        where post.idUser=users.id AND posts.id=postemas.idPost AND
        tags.id=poststemas.idTag AND categoria=:c";
        $stmt=parent::$conexion->prepare($con);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al devolver los posts. Mensaje:".$ex->getMessage());
        }
        return $stmt;
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