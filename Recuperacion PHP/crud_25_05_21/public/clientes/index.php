<?php
session_start();
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use Clases\Clientes;

$cli = new Clientes();
$todos = $cli->getTodos();
$cli = null;

require dirname(__DIR__, 2) . "/plantillas/cabecera.php";
?>
<h3 class="text-center mt-2">Clientes registrados</h3>
<?php
     require dirname(__DIR__, 2) . "/plantillas/mensajes.php";
?>
<div class="container mt-3">
    <a href="create.php" class="btn btn-success mb-2"><i class="fas fa-plus"></i> Nuevo</a>
    <table class="table table-dark table-striped" id="tabCliente">
        <thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Apellidos, nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($fila=$todos->fetch(PDO::FETCH_OBJ)) {
                 echo <<< TEXTO
                 <tr>
                 <th scope="row">{$fila->id}</th>
                 <td>{$fila->apellidos}, {$fila->nombre}</td>
                 <td>{$fila->email}</td>
                 <td>
                    <form name="as" action="borrar.php" method="POST" class="form form-inline">
                    <a href="update.php?id={$fila->id}" class="btn btn-secondary"><i class="fas fa-edit"></i> Editar</a>
                    <input type="hidden" name="id" value="{$fila->id}">
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> Borrar</button>
                    </form>
                 </td>
                 </tr>
                 TEXTO;
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#tabCliente').DataTable();
} );
</script>
</body>

</html>