<?php
    namespace Clases;
    require '../vendor/autoload.php';
    use Faker\Factory;
    use Clases\{Users,Tags,Post, PostTemas};
    class Datos{
        public $faker;

        public function __construct($tabla, $cantidad) {
            $this->faker=Factory::create('es_ES');
            switch ($tabla) {
                case "users":
                    $this->crearUsuarios($cantidad);
                    break;
                case "tags":
                    $this->crearTags($cantidad);
                    break;
                case "post":
                    $this->crearPost($cantidad);
            }
        }
        public function crearUsuarios($n){
            //Creamos un usuario Admin
            $usuario = new Users();
            //Borro los anteriores
            $usuario->borrarTodo();
            $usuario->setNombre("Manolo");
            $usuario->setApellidos("Gil Gil");
            $usuario->setUsername("admin");
            $usuario->setMail("admin@mail.com");
            $pass=hash('sha256', "secret0");
            $usuario->setPass($pass);
            $usuario->create();
            //Creamos el resto
            for ($i=0; $i < $n-1; $i++) { 
                $usuario->setNombre($this->faker->firstName());
                $usuario->setApellidos($this->faker->lastName()." ". $this->faker->lastName());
                $usuario->setUsername($this->faker->unique()->userName);
                $usuario->setMail($this->faker->unique()->email);
                $usuario->setPass($this->faker->sha256);
                $usuario->create();
            }
            $usuario=null;
        }
        //--------------------------------------------------------------------------------------------
        public function crearTags() {
            $temas = ['Informatica', 'Anime', 'Terror', 'Programacion', 'PHP', 'Java', 'Cine', 'Videojuegos', 'Historia'];
            $tags= new Tags();
            $tags->BorrarTodo();
            for ($i=0; $i < count($temas); $i++) { 
                $tags->setCategoria($temas[$i]);
                $tags->create();
            }
            $tags=null;
        }
        //--------------------------------------------------------------------------------------------------------
        public function crearPost($n) {
            //recupero en un array los ids de usuarios y de tags
            $arrayUsers=(new Users())->usuariosId();
            $arrayTags=(new Tags())->tagsId();
            $estePost=new Post();
            for ($i=0; $i < $n; $i++) { 
                $estePost->setTitulo($this->faker->word());
                $estePost->setCuerpo($this->faker->text(250));
                $indice=rand(0, count($arrayUsers)-1);
                $estePost->setIdUser($arrayUsers[$indice]);
                $estePost->create();
                //Ya hemos creado el post ahora le asociamos 
                //un numero aleatorio de categorias
                //1. - Recupero el id del post que acabo de crear
                $idPost=Conexion::getConexion()->lastInsertId();
                $cantTags=rand(1, count($arrayTags));
                for ($j=0; $j < $cantTags; $j++) { 
                    $postTema=new PostTemas();
                    $postTema->setIdPost($idPost);
                    $postTema->setIdTags($arrayTags[$j]);
                    $postTema->create();
                }
                //desordenamos el array de temas
                shuffle($arrayTags);
            }
            $postTema = null;
            $estePost = null;
        }
    }