<?php
    namespace Clases;
    use Clases\Conexion;
    use PDO;
    use PDOException;
class PostTemas extends Conexion {
    private $id;
    private $idTags;
    private $idPost;

    public function __construct()
    {
        parent::__construct();
    }
    //-------------------------------CRUD----------------------------------------------
    public function create() {
        $con = "insert into poststemas(idTag, idPost) values(:it, :ip)";
        $stmt=parent::$conexion->prepare($con);

        try {
            $stmt->execute([
                ':it'=>$this->idTags,
                ':ip'=>$this->idPost
            ]);
        } catch (PDOException $ex) {
            die("Error al insertar en postTemas, ".$ex->getMessage());
        }
    }
    public function read() {

    }
    public function update() {

    }
    public function delete() {

    }


    //----------------------------------------------------------------------------------
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
     * Get the value of idTags
     */ 
    public function getIdTags()
    {
        return $this->idTags;
    }

    /**
     * Set the value of idTags
     *
     * @return  self
     */ 
    public function setIdTags($idTags)
    {
        $this->idTags = $idTags;

        return $this;
    }

    /**
     * Get the value of idPost
     */ 
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * Set the value of idPost
     *
     * @return  self
     */ 
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }
}