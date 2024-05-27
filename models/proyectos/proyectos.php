<?php
// Incluir el archivo de sesión
require '../../sesion.php';

// Conexión a la base de datos
require '../../config/conexion.php';

// # Traer los registros para mostrarlos en la tabla juntandola con la tabla clientes
$consultaProyecto = $conexionbd->prepare("SELECT proyectos.idProyecto, proyectos.nombre, proyectos.lugar, proyectos.fechaInicio, proyectos.fechaFin, clientes.nombre AS nombreCliente
    FROM proyectos INNER JOIN clientes ON proyectos.idCliente = clientes.idCliente
");
$consultaProyecto->execute();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Proyectos</title>

    <link rel="stylesheet" href="/proyectoWT/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyectoWT/assets/css/all.min.css">
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
    <!-- contenedor principal Proyectos-->

    <div class="container py-4">

        <div class="card text-bg-info mb-3">
            <span class="placeholder-wave col-12 placeholder-lg bg-success">
                <h2 class="card-header text-center text-light"><i class="fa-solid fa-city"></i> Proyectos</h2>
            </span>
        </div>

        <!-- Mensaje de advertencia -->
        <?php
        if (isset($_SESSION['mensaje']) && isset($_SESSION['color'])) {
        ?>

            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensaje'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            // Para que no salte una y otra vez!!
            unset($_SESSION['color']);
            unset($_SESSION['mensaje']);
        }

        ?>

        <!-- botón con referencia -->
        <div class="d-grid col-3 mx-auto">
        <?php if ($_SESSION['rol'] == 1) : ?>
            <a href="#" class="btn btn-outline-success p-1" data-bs-toggle="modal" data-bs-target="#nuevoProyectoModal"><i class="fa-solid fa-circle-plus"></i> Agregar Nuevo Proyecto</a>
            <?php else : ?>
                <button class='btn btn-outline-success p-1' onclick="alert('No tienes permisos, contacta con el administrador.'); return false;"><i class='fa-solid fa-circle-plus'></i> Agregar Nuevo Proyecto</button>
            <?php endif; ?>
        </div>

        <!-- Tabla para mostrar datos PROYECTOS -->
        <div class="table-responsive-sm">
            <table class="table table-sm table-hover table-bordered mt-2" style="font-size: 0.8em;">
                <!-- cabecera de la Tabla -->
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Proyecto</th>
                        <th>Lugar</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                        <th>Cliente asociado</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <!-- cuerpo de la Tabla -->
                <tbody class="table-success">
                    <?php while ($registro = $consultaProyecto->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td class='table-dark'><?= htmlspecialchars($registro['idProyecto']); ?></td>
                            <td><?= htmlspecialchars($registro['nombre']); ?></td>
                            <td><?= htmlspecialchars($registro['lugar']); ?></td>
                            <td><?= htmlspecialchars($registro['fechaInicio']); ?></td>
                            <td><?= htmlspecialchars($registro['fechaFin']); ?></td>
                            <td><?= htmlspecialchars($registro['nombreCliente']); ?></td>
                            <td>
                                <?php if ($_SESSION['rol'] == 1) : ?>
                                    <a href='#' class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editarProyectoModal' data-bs-id='<?= htmlspecialchars($registro['idProyecto']); ?>'>
                                        <i class='fa-solid fa-pen-to-square'></i>
                                    </a>
                                    <a href='#' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarProyectoModal' data-bs-id='<?= htmlspecialchars($registro['idProyecto']); ?>'>
                                        <i class='fa-solid fa-trash'></i>
                                    </a>
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

        <?php
        // # Traer el CLIENTE al PROYECTO 
        $consultaCliente = $conexionbd->prepare("SELECT idCliente, nombre FROM clientes");
        $consultaCliente->execute();
        ?>

        <!-- inlusión del archivo donde está el elemento emergente del botón -->
        <?php
        include 'nuevoProyectoModal.php';
        // Reinicio del fetch() para mostrar el nombre del cliente en editarProyecto
        $consultaCliente->execute();
        include 'editarProyectoModal.php';
        include 'eliminarProyectoModal.php';
        ?>

        <!-- evento para visualizar y ocultar -->
        <script>
            // # limpiar datos
            let nuevoProyectoModal = document.getElementById('nuevoProyectoModal')
            // # editar el cliente
            let editarProyectoModal = document.getElementById('editarProyectoModal')
            // # eliminar el cliente
            let eliminarProyectoModal = document.getElementById('eliminarProyectoModal')

            // ## Evento para limpiar datos
            nuevoProyectoModal.addEventListener('hide.bs.modal', event => {})

            // ## Evento para editar datos
            editarProyectoModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')
                // # para saber qué elemento debe ser editado # definido en editaModal.php (div)
                let inputId = editarProyectoModal.querySelector('.modal-body #idProyecto')
                let inputNombre = editarProyectoModal.querySelector('.modal-body #nombre')
                let inputLugar = editarProyectoModal.querySelector('.modal-body #lugar')
                let inputFechaInicio = editarProyectoModal.querySelector('.modal-body #fechaInicio')
                let inputFechaFin = editarProyectoModal.querySelector('.modal-body #fechaFin')
                let inputIdCliente = editarProyectoModal.querySelector('.modal-body #idCliente')

                // Petición AJAX
                let url = "seleccionarProyecto.php"
                let formData = new FormData()
                formData.append('idProyecto', id)

                fetch(url, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        inputId.value = data.idProyecto;
                        inputNombre.value = data.nombre;
                        inputLugar.value = data.lugar;
                        inputFechaInicio.value = data.fechaInicio;
                        inputFechaFin.value = data.fechaFin;
                        inputIdCliente.value = data.idCliente;
                    })
                    .catch(err => console.log(err))
            })

            // ## Evento para Eliminar ##
            eliminarProyectoModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')

                eliminaProyectoModal.querySelector('.modal-footer #idProyecto').value = id
            })
        </script>

    </div>

    <script src="/proyectoWT/assets/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <?php
    require_once('../footer.php');
    ?>
</footer>

</html>