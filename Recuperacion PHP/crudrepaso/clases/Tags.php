<?php
    namespace Clases;
    use Clases\Conexion;
    use PDO;
    use PDOException;
    class Tags extends Conexion{
        private $id;
        private $categoria;

        public function __construct(){
            parent::__construct();
        }
        //----------------------CRUD-------------------------------------
        public function create() {
            $con = "insert into tags(categoria) values(:c)";
            $stmt = parent::$conexion->prepare($con);

            try {
                $stmt->execute([
                    ':c'=>$this->categoria
                ]);
            } catch (PDOException $ex) {
                die("Error al insertar tag ".$ex->getMessage());
            }
        }
        public function read() {
            $con = "select * from tags where id=:i";
            $stmt=parent::$conexion->prepare($con);

            try {
                $stmt->execute([
                    ':i'=>$this->id
                ]);
            } catch (PDOException $ex) {
                die("Error al leer  el tag: ". $ex->getMessage());
            }
            $fila=$stmt->fetch(PDO::FETCH_OBJ);
            return $fila->categoria;
        }
        public function update() {
            $con = "update tags set categoria=:c where id=:i";
            $stmt=parent::$conexion->prepare($con);

            try {
                $stmt->execute([
                    ':c'=>$this->categoria,
                    ':i'=>$this->id
                ]);
            } catch (PDOException $ex) {
                die("Error al actualizar el tag ".$ex->getMessage());
            }
        }
        public function delete() {
            $con = "delete from tags where id=:i";
            $stmt=parent::$conexion->prepare($con);

            try {
                $stmt->execute([
                    ':i'=>$this->id
                ]);
            } catch (PDOException $ex) {
                die("Error al borrar el tag ".$ex->getMessage());
            }
        }
        
        public function BorrarTodo() {
            $con = "delete from tags";
            $stmt=parent::$conexion->prepare($con);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die("Error al borrar los tags ".$ex->getMessage());
            }
        }

        public function devolverTodo() {
            $con = "select * from tags order by categoria";
            $stmt=parent::$conexion->prepare($con);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die("Error al devolver los tags ".$ex->getMessage());
            }
            return $stmt;
        }

        //Metodo para averiguar si un tag existe
        public function existeTag($tag) {
            $c = "select * from tags where categoria=:c";
            $stmt=parent::$conexion->prepare($c);
            try {
                $stmt->execute([
                    ':c'=>$tag
                ]);
            } catch (PDOException $ex) {
                die("Error al comporobar si existe Tag ". $ex->getMessage());
            }
            $fila=$stmt->fetch(PDO::FETCH_OBJ);
            return ($fila==null) ? false : true;
        }
        //-----------------------------------------------------------
        public function tagsId() {
            $c="select id from tags";
            $stmt = parent::$conexion->prepare($c);

            try {
                    $stmt->execute();
            } catch (PDOException $ex) {
                    die("Error al extraer ids de tags, ".$ex->getMessage());
            }
            $idTags=[];
            while ($fila=$stmt->fetch(PDO::FETCH_OBJ)) {
                    $idTags[]=$fila->id;
            }
            return $idTags;
    }
        //------------------------------------------------------------
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
         * Get the value of categoria
         */ 
        public function getCategoria()
        {
                return $this->categoria;
        }

        /**
         * Set the value of categoria
         *
         * @return  self
         */ 
        public function setCategoria($categoria)
        {
                $this->categoria = $categoria;

                return $this;
        }
    }