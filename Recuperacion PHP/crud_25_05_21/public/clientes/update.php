<?php
if (!isset($_GET['id'])) {
    header("location:index.php");
    die();
}
$id = $_GET['id'];

session_start();
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\Clientes;
function mostrarError($text)
{
    global $id;
    $_SESSION['errores'] = $text;
    header("location: {$_SERVER['PHP_SELF']}?id=$id");
    die();
}


$cli = new Clientes();
$datos = $cli->read($id);


if (isset($_POST['editar'])) {
    #Procesamos el formulario
    $n=ucwords(trim($_POST['nombre']));
    $a=ucwords(trim($_POST['apellidos']));
    $m=trim($_POST['email']);
    if (strlen($n)==0 || strlen($a)==0) {
        mostrarError("Rellena los campos!");
    }
    $cli = new Clientes();
    if ($cli->existeEmailU($m, $id)) {
        mostrarError("El correo ya esta registrado");
    }

    $cli->setNombre($n);
    $cli->setApellidos($a);
    $cli->setEmail($m);
    $cli->setId($id);
    $cli->update();
    
    $cli = null;
    $_SESSION['mensaje']= "Cliente Actualizado con exito";
    header("location:index.php");
} else {
    //pintamos el formulario
    require dirname(__DIR__, 2) . "/plantillas/cabecera.php";
?>
    <h3 class="text-center mt-2">Nuevo Cliente</h3>
    <?php
     require dirname(__DIR__, 2) . "/plantillas/errores.php";
    ?>
    <div class="container mt-3">
    
        <form action="<?php echo $_SERVER['PHP_SELF']."?id=$id" ?>" method="post">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Apellidos</span>
                <input type="text" name="apellidos" required class="form-control" value="<?php echo $datos->apellidos; ?>" aria-label="Apellidos" aria-describedby="addon-wrapping">
                <span class="input-group-text" id="addon-wrapping">Nombre</span>
                <input type="text" name="nombre" required class="form-control" value="<?php echo $datos->nombre; ?>" aria-label="Nombre" aria-describedby="addon-wrapping">
            </div>
            <div class="input-group flex-nowrap mt-2">
                <span class="input-group-text" id="addon-wrapping">Email</span>
                <input type="email" name="email" required class="form-control" value="<?php echo $datos->email; ?>" aria-label="Email" aria-describedby="addon-wrapping">
            </div>
            <div class="mt-2">
            <button type="submit" name="editar" class="btn btn-info"><i class="fas fa-save"></i> Enviar</button>
            <button type="reset" name="borrar" class="btn btn-info"><i class="fas fa-trash"></i> Limpiar</button>
            <a href="index.php" class="btn btn-primary"><i class="fas fa-backward"></i> Volver</a>
            </div>
        </form>
    </div>
    </body>

    </html>
<?php } ?>