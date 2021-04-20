<?php
    namespace Clases;
    require '../vendor/autoload.php';
    use Faker\Factory;
    use Clases\Users;
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
    }