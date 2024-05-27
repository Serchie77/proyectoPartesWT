<?php
// Incluir el archivo de sesión
require '../../sesion.php';

// Conexión a la base de datos
require '../../config/conexion.php';

// Obtener el ID del usuario logueado
$idUsuario = $_SESSION['idUsuario'];

// # Traer los registros y mostrarlos en la tabla y UNIR
if ($_SESSION['rol'] == 1) {

    $consultaHora = $conexionbd->prepare("SELECT partesHoras.idParteHora, partesHoras.fecha, partesHoras.horasNormales, partesHoras.horasExtras, partes.idParte,
    usuarios.nombre AS nombreUsuario, proyectos.nombre AS nombreProyecto, partes.comentarios AS comentarioParte
    FROM partesHoras 
    INNER JOIN partes ON partesHoras.idParte = partes.idParte
    INNER JOIN usuarios ON partesHoras.idUsuario = usuarios.idUsuario
    INNER JOIN proyectos ON partes.idProyecto = proyectos.idProyecto");
    $consultaHora->execute();
} else {

    $consultaHora = $conexionbd->prepare("SELECT partesHoras.idParteHora, partesHoras.fecha, partesHoras.horasNormales, partesHoras.horasExtras, partes.idParte,
    usuarios.nombre AS nombreUsuario, proyectos.nombre AS nombreProyecto, partes.comentarios AS comentarioParte
    FROM partesHoras 
    INNER JOIN partes ON partesHoras.idParte = partes.idParte
    INNER JOIN usuarios ON partesHoras.idUsuario = usuarios.idUsuario
    INNER JOIN proyectos ON partes.idProyecto = proyectos.idProyecto 
    WHERE partesHoras.idUsuario = :idUsuario");


    $consultaHora->bindParam(':idUsuario', $idUsuario);
    $consultaHora->execute();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Horas</title>

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
    <!-- contenedor principal partesHoras-->

    <div class="container py-3">

        <div class="card text-bg-warning mb-3">
            <span class="placeholder-wave col-12 placeholder-lg bg-warning">
                <h2 class="card-header text-center text-light"><i class="fa-solid fa-clock"></i> Horas Diarias</h2>
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
            <a href="#" class="btn btn-outline-success p-1" data-bs-toggle="modal" data-bs-target="#nuevoHoraModal"><i class="fa-solid fa-circle-plus"></i> Agregar Horas</a>
        </div>

        <!-- Tabla para mostrar datos partesHoras -->
        <div class="table-responsive-sm">
            <table class="table table-striped table-sm table-hover table-bordered mt-2" style="font-size: 0.8em;">
                <!-- cabecera de la Tabla -->
                <thead class="table-warning">
                    <tr>
                        <th>Nombre Trabajador</th>
                        <th>Fecha del Parte</th>
                        <th>Horas Normales</th>
                        <th>Horas Extras</th>
                        <th>Nombre proyecto</th>
                        <th>Referencia</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <!-- cuerpo de la Tabla -->
                <tbody class="table-secundary">
                    <?php while ($registro = $consultaHora->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?= $registro['nombreUsuario'] ?></td>
                            <td><?= $registro['fecha'] ?></td>
                            <td><?= $registro['horasNormales'] ?></td>
                            <td><?= $registro['horasExtras'] ?></td>
                            <td><?= $registro['nombreProyecto'] ?></td>
                            <td><?= $registro['comentarioParte'] ?></td>
                            <td>
                                <a href='#' class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editarHoraModal' data-bs-id='<?= $registro['idParteHora'] ?>'>
                                    <i class='fa-solid fa-pen-to-square'></i>
                                </a>
                                <a href='#' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#eliminarHoraModal' data-bs-id='<?= $registro['idParteHora'] ?>'>
                                    <i class='fa-solid fa-trash'></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php
        // # Traer el COMENTARIOS de PARTE a las HORAS 
        $consultaParte = $conexionbd->prepare("SELECT idParte, comentarios FROM partes");
        $consultaParte->execute();
        // # Traer el PARTE--->> PROYECTOS a las HORAS 
        $consultaProyecto = $conexionbd->prepare("SELECT idProyecto, nombre FROM proyectos");
        $consultaProyecto->execute();
        // # Traer el USUARIO a las HORAS
        $consultaUsuario = $conexionbd->prepare("SELECT idUsuario, nombre FROM usuarios");
        $consultaUsuario->execute();
        ?>

        <!-- inlusión del archivo donde está el elemento emergente del botón -->
        <?php
        include 'nuevoHoraModal.php';
        // Reinicio del fetch() para mostrar el PARTE y USUARIO en editarHoraModal
        $consultaParte->execute();
        $consultaProyecto->execute();
        $consultaUsuario->execute();
        include 'editarHoraModal.php';
        include 'eliminarHoraModal.php';
        ?>

        <!-- evento para visualizar y ocultar -->
        <script>
            // # limpiar datos
            let nuevoHoraModal = document.getElementById('nuevoHoraModal')
            // # editar el cliente
            let editarHoraModal = document.getElementById('editarHoraModal')
            // # eliminar el cliente
            let eliminarHoraModal = document.getElementById('eliminarHoraModal')

            // ## Evento para limpiar datos
            nuevoHoraModal.addEventListener('hide.bs.modal', event => {})

            // ## Evento para editar datos
            editarHoraModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')
                // # para saber qué elemento debe ser editado # definido en editaModal.php (div)
                let inputId = editarHoraModal.querySelector('.modal-body #idParteHora')
                let inputFecha = editarHoraModal.querySelector('.modal-body #fecha')
                let inputHorasNormales = editarHoraModal.querySelector('.modal-body #horasNormales')
                let inputHorasExtras = editarHoraModal.querySelector('.modal-body #horasExtras')
                let inputIdParte = editarHoraModal.querySelector('.modal-body #idParte')
                let inputIdUsuario = editarHoraModal.querySelector('.modal-body #idUsuario')

                // Petición AJAX
                let url = "seleccionarHora.php"
                let formData = new FormData()
                formData.append('idParteHora', id)

                fetch(url, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        inputId.value = data.idParteHora;
                        inputFecha.value = data.fecha;
                        inputHorasNormales.value = data.horasNormales;
                        inputHorasExtras.value = data.horasExtras;
                        inputIdParte.value = data.idParte;
                        inputIdUsuario.value = data.idUsuario;
                    })
                    .catch(err => console.log(err))
            })

            // ## Evento para Eliminar ##
            eliminarHoraModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                eliminarHoraModal.querySelector('.modal-footer #idParteHora').value = id;
            });
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