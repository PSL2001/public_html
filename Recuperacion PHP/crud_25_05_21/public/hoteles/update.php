<?php
if (!isset($_GET['id'])) {
    header("location:index.php");
    die();
}
$id = $_GET['id'];

session_start();
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\Hoteles;
function mostrarError($text)
{
    global $id;
    $_SESSION['errores'] = $text;
    header("location: {$_SERVER['PHP_SELF']}?id=$id");
    die();
}


$hotel = new Hoteles();
$datos = $hotel->read($id);


if (isset($_POST['editar'])) {
    #Procesamos el formulario
    $n=ucwords(trim($_POST['nombre']));
    $l=ucwords(trim($_POST['localidad']));
    $d=trim($_POST['direccion']);
    if (strlen($n)==0 || strlen($l)==0 || strlen($d)==0) {
        mostrarError("Rellena los campos!");
    }
    $hotel = new Hoteles();
    if ($hotel->existeNombreU($n, $id)) {
        mostrarError("El nombre ya esta registrado");
    }

    $hotel->setNombre($n);
    $hotel->setLocalidad($l);
    $hotel->setDireccion($d);
    $hotel->setId($id);
    $hotel->update();
    
    $hotel = null;
    $_SESSION['mensaje']= "Hotel Actualizado con exito";
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
                <span class="input-group-text" id="addon-wrapping">Nombre</span>
                <input type="text" name="nombre" required class="form-control" value="<?php echo $datos->nombre; ?>" aria-label="nombre" aria-describedby="addon-wrapping">
                <span class="input-group-text" id="addon-wrapping">Localidad</span>
                <input type="text" name="localidad" required class="form-control" value="<?php echo $datos->localidad; ?>" aria-label="Localidad" aria-describedby="addon-wrapping">
            </div>
            <div class="input-group flex-nowrap mt-2">
                <span class="input-group-text" id="addon-wrapping">Direccion</span>
                <input type="text" name="direccion" required class="form-control" value="<?php echo $datos->direccion; ?>" aria-label="Email" aria-describedby="addon-wrapping">
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