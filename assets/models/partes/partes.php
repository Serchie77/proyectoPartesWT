<!-- Recuperamos la conexión BD -->
<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// # Traer los registros y mostrarlos en la tabla y UNIR
$consultaParte = $conexionbd->prepare("SELECT partes.idParte, partes.fechaInicio, partes.fechaFin, partes.totalHorasNormales, partes.totalHorasExtras, partes.horasViaje, partes.comentarios, usuarios.nombre AS nombreUsuario, proyectos.nombre AS nombreProyecto
    FROM partes
    INNER JOIN usuarios ON partes.idUsuario = usuarios.idUsuario
    INNER JOIN proyectos ON partes.idProyecto = proyectos.idProyecto");
$consultaParte->execute();

/*
// # Para mostrar la imagen o documento
$dir = "imagen/";
// # Faltaría incluir en la tabla el registro de la imagen en sí
*/

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Partes</title>

    <link rel="stylesheet" href="/proyectoWT/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyectoWT/assets/css/all.min.css">
</head>

<body>
    <!-- contenedor principal partes-->

    <div class="container py-3">

        <div class="card text-bg-danger mb-3">
            <span class="placeholder-wave col-12 placeholder-lg bg-danger">
                <h2 class="card-header text-center text-light"><i class="fa-solid fa-calendar-days"></i> Partes Trabajadores</h2>
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
            <a href="#" class="btn btn-outline-success p-1" data-bs-toggle="modal" data-bs-target="#nuevoParteModal"><i class="fa-solid fa-circle-plus"></i> Agregar Parte Nuevo</a>
        </div>

        <!-- Tabla para mostrar datos partes -->
        <div class="table-responsive-sm">
            <table class="table table-striped table-sm table-over table-bordered mt-2">
                <!-- cabecera de la Tabla -->
                <thead class="table-danger">
                    <tr>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Total Horas Normales</th>
                        <th>Total Horas Extras</th>
                        <th>Horas Viaje</th>
                        <th>Comentarios</th>
                        <th>Trabajador</th>
                        <th>Proyecto</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <!-- cuerpo de la Tabla -->
                <tbody class="table-secundary">
                    <?php
                    while ($registro = $consultaParte->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                            <td >{$registro['fechaInicio']}</td>
                            <td >{$registro['fechaFin']}</td>
                            <td >{$registro['totalHorasNormales']}</td>
                            <td >{$registro['totalHorasExtras']}</td>
                            <td >{$registro['horasViaje']}</td>
                            <td >{$registro['comentarios']}</td>
                            <td >{$registro['nombreUsuario']}</td>
                            <td >{$registro['nombreProyecto']}</td>

                            <td>
                                <a href='#' class='btn btn-sm btn-warning' data-bs-toggle='modal' 
                                data-bs-target='#editarParteModal' data-bs-id='{$registro['idParte']}'> <i class='fa-solid fa-pen-to-square'></i> Editar</a> 
                        
                                <a href='#' class='btn btn-sm btn-danger' data-bs-toggle='modal' 
                                data-bs-target='#eliminarParteModal' data-bs-id='{$registro['idParte']}'> <i class='fa-solid fa-trash'></i> Eliminar</a>
                            </td>
                        <tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <?php
        // # Traer el USUARIO a los PARTES
        $consultaUsuario = $conexionbd->prepare("SELECT idUsuario, nombre FROM usuarios");
        $consultaUsuario->execute();
        // # Traer el PROYECTO a los PARTES
        $consultaProyecto = $conexionbd->prepare("SELECT idProyecto, nombre FROM proyectos");
        $consultaProyecto->execute();
        // # Traer al hacer click en un proyecto o cliente todos los datos
        ?>

        <!-- inlusión del archivo donde está el elemento emergente del botón -->
        <?php
        include 'nuevoParteModal.php';
        // Reinicio del fetch() para mostrar el USUARIO y PROYECTO en editarParteModal
        $consultaUsuario->execute();
        $consultaProyecto->execute();
        include 'editarParteModal.php';
        include 'eliminarParteModal.php';
        ?>

        <!-- evento para visualizar y ocultar -->
        <script>
            // # limpiar datos
            let nuevoParteModal = document.getElementById('nuevoParteModal')
            // # editar el cliente
            let editarParteModal = document.getElementById('editarParteModal')
            // # eliminar el cliente
            let eliminarParteModal = document.getElementById('eliminarParteModal')

            // ## Evento para limpiar datos
            nuevoParteModal.addEventListener('hide.bs.modal', event => {})

            // ## Evento para editar datos
            editarParteModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')
                // # para saber qué elemento debe ser editado # definido en editaModal.php (div)
                let inputId = editarParteModal.querySelector('.modal-body #idParte')
                let inputFechaInicio = editarParteModal.querySelector('.modal-body #fechaInicio')
                let inputFechaFin = editarParteModal.querySelector('.modal-body #fechaFin')
                let inputTotalHorasNormales = editarParteModal.querySelector('.modal-body #totalHorasNormales')
                let inputTotalHorasExtras = editarParteModal.querySelector('.modal-body #totalHorasExtras')
                let inputHorasViaje = editarParteModal.querySelector('.modal-body #horasViaje')
                let inputComentarios = editarParteModal.querySelector('.modal-body #comentarios')
                let inputIdUsuario = editarParteModal.querySelector('.modal-body #idUsuario')
                let inputIdProyecto = editarParteModal.querySelector('.modal-body #idProyecto')

                // Petición AJAX
                let url = "seleccionarParte.php"
                let formData = new FormData()
                formData.append('idParte', id)

                fetch(url, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        inputId.value = data.idParte;
                        inputFechaInicio.value = data.inputFechaInicio;
                        inputFechaFin.value = data.inputFechaFin;
                        inputTotalHorasNormales.value = data.totalHorasNormales;
                        inputTotalHorasExtras.value = data.totalHorasExtras;
                        inputhorasViaje.value = data.horasViaje;
                        inputIdComentarios.value = data.comentarios;
                        inputIdUsuario.value = data.idUsuario;
                        inputIdProyecto.value = data.idProyecto;
                        
                    })
                    .catch(err => console.log(err))
            })

            // ## Evento para Eliminar ##
            eliminarParteModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')

                eliminaParteModal.querySelector('.modal-footer #idParte').value = id
            })
        </script>

    </div>

    <script src="/proyectoWT/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>