<!-- Recuperamos la conexión BD -->
<?php
// Incluir el archivo de sesión
require '../../sesion.php';

// Conexión a la base de datos
require '../../config/conexion.php';

try {
    // Traer los registros de la tabla
    $consultaCliente = $conexionbd->prepare("SELECT * FROM clientes");
    $consultaCliente->execute();
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Clientes</title>

    <!-- <link rel="stylesheet" href="../../assets/css/bootswatch-spacelab/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/all.min.css">
</head>

<header>
    <?php
    if ($_SESSION['rol'] == 1) {

        require_once('../headerAdmin.php');
    } elseif ($_SESSION['rol'] == 2) {
        require_once('../headerUser.php');
    }
    ?>
</header>


<body>
    <div class="container py-4">
        <!-- Mostrar mensaje de sesión -->
        <?php if (isset($_SESSION['mensaje'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            // Elimina el mensaje de la sesión después de mostrarlo
            unset($_SESSION['mensaje']);
            unset($_SESSION['color']);
            ?>
        <?php endif; ?>

        <div class="card mb-3 shadow-lg">
            <span class="placeholder-wave col-12 placeholder-lg bg-primary">
                <h2 class="card-header text-center text-light"><i class="fa-solid fa-briefcase"></i> Clientes</h2>
            </span>
        </div>
        <!-- botón con referencia - Restringido para no administradores-->
        <div class="d-grid col-3 mx-auto">
            <?php if ($_SESSION['rol'] == 1) : ?>
                <a href="#" class="btn btn-outline-success p-1" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal"><i class="fa-solid fa-circle-plus"></i> Agregar Nuevo Cliente</a>
            <?php else : ?>
                <button class='btn btn-outline-success p-1' onclick="alert('No tienes permisos, contacta con el administrador.'); return false;"><i class='fa-solid fa-circle-plus'></i> Agregar Nuevo Cliente</button>
            <?php endif; ?>
        </div>

        <!-- Tabla para mostrar datos Cliente -->
        <div class="table-responsive-sm">
            <table class="table table-sm table-hover table-bordered mt-2" style="font-size: 0.8em;">
                <!-- cabecera de la Tabla -->
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- cuerpo de la Tabla -->
                <tbody class="table-primary">
                    <?php while ($registro = $consultaCliente->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td class="table-dark"><?= htmlspecialchars($registro['idCliente']); ?></td>
                            <td><?= htmlspecialchars($registro['nombre']); ?></td>
                            <td><?= htmlspecialchars($registro['apellidos']); ?></td>
                            <td><?= htmlspecialchars($registro['email']); ?></td>
                            <td><?= htmlspecialchars($registro['telefono']); ?></td>
                            <td><?= htmlspecialchars($registro['direccion']); ?></td>
                            <td><?= htmlspecialchars($registro['comentarios']); ?></td>
                            <td>
                                <?php if ($_SESSION['rol'] == 1) : ?>
                                    <a href="#" class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editarClienteModal' data-bs-id='<?= htmlspecialchars($registro['idCliente']); ?>'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href="#" class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarClienteModal' data-bs-id='<?= htmlspecialchars($registro['idCliente']); ?>'><i class='fa-solid fa-trash'></i> </a>
                                <?php else : ?>
                                    <button class='btn btn-sm btn-warning' onclick="alert('No tienes permisos, contacta con el administrador.'); return false;"><i class='fa-solid fa-pen-to-square'></i></button>
                                    <button class='btn btn-sm btn-danger' onclick="alert('No tienes permisos, contacta con el administrador.'); return false;"><i class='fa-solid fa-trash'></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>

        <!-- Inclusión de los modales -->
        <?php include 'nuevoClienteModal.php'; ?>
        <?php include 'editarClienteModal.php'; ?>
        <?php include 'eliminarClienteModal.php'; ?>

        <!-- Eventos para los modales -->
        <script>
            let nuevoClienteModal = document.getElementById('nuevoClienteModal');
            let editarClienteModal = document.getElementById('editarClienteModal');
            let eliminarClienteModal = document.getElementById('eliminarClienteModal');

            nuevoClienteModal.addEventListener('hide.bs.modal', event => {
                // Código para limpiar los datos del modal
            });

            editarClienteModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                let inputId = editarClienteModal.querySelector('.modal-body #idCliente');
                let inputNombre = editarClienteModal.querySelector('.modal-body #nombre');
                let inputApellidos = editarClienteModal.querySelector('.modal-body #apellidos');
                let inputEmail = editarClienteModal.querySelector('.modal-body #email');
                let inputTelefono = editarClienteModal.querySelector('.modal-body #telefono');
                let inputDireccion = editarClienteModal.querySelector('.modal-body #direccion');
                let inputComentarios = editarClienteModal.querySelector('.modal-body #comentarios');

                let url = "seleccionarCliente.php";
                let formData = new FormData();
                formData.append('idCliente', id);

                fetch(url, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        inputId.value = data.idCliente;
                        inputNombre.value = data.nombre;
                        inputApellidos.value = data.apellidos;
                        inputEmail.value = data.email;
                        inputTelefono.value = data.telefono;
                        inputDireccion.value = data.direccion;
                        inputComentarios.value = data.comentarios;
                    })
                    .catch(err => console.log(err));
            });

            eliminarClienteModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                eliminarClienteModal.querySelector('.modal-footer #idCliente').value = id;
            });
        </script>
    </div>

    <footer>
        <?php
        require_once('../footer.php');
        ?>
    </footer>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>