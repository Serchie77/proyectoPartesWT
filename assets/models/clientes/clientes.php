<!-- Recuperamos la conexión BD -->
<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// # Traer los registros de la tabla
$consultaCliente = $conexionbd->prepare("SELECT * FROM clientes");
$consultaCliente->execute();
/*
// # Para mostrar la imagen o documento
$dir = "imagen/";
// # Faltaría incluir en la tabla el registro de la imagen en sí
*/
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Clientes</title>

    <link rel="stylesheet" href="/proyectoWT/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyectoWT/assets/css/all.min.css">
</head>

<body> -->
    <!-- contenedor principal Clientes-->

    <div class="container py-3">
        <div class="card text-bg-info mb-3">
            <span class="placeholder-wave col-12 placeholder-lg bg-primary">
                <h2 class="card-header text-center text-light"><i class="fa-solid fa-briefcase"></i> Clientes</h2>
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
            <a href="#" class="btn btn-outline-success p-1" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal"><i class="fa-solid fa-circle-plus"></i> Agregar Nuevo Cliente</a>
        </div>

        <!-- Tabla para mostrar datos Cliente -->
        <div class="table-responsive-sm">
            <table class="table table-sm table-over table-bordered mt-2">
                <!-- cabecera de la Tabla -->
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>nombre</th>
                        <th>apellidos</th>
                        <th>email</th>
                        <th>telefono</th>
                        <th>dirección</th>
                        <th>comentarios</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <!-- cuerpo de la Tabla -->
                <tbody class="table-primary">
                    <?php
                    while ($registro = $consultaCliente->fetch()) {

                        echo "<tr>
                            <td class='table-dark'>{$registro['idCliente']}</td>
                            <td>{$registro['nombre']}</td>
                            <td>{$registro['apellidos']}</td>
                            <td>{$registro['email']}</td>
                            <td>{$registro['telefono']}</td>
                            <td>{$registro['direccion']}</td>
                            <td>{$registro['comentarios']}</td>

                            <td>
                                <a href='#' class='btn btn-sm btn-warning' data-bs-toggle='modal' 
                                data-bs-target='#editarClienteModal' data-bs-id='{$registro['idCliente']}'> <i class='fa-solid fa-pen-to-square'></i> Editar</a> 
                        
                                <a href='#' class='btn btn-sm btn-danger' data-bs-toggle='modal' 
                                data-bs-target='#eliminarClienteModal' data-bs-id='{$registro['idCliente']}'> <i class='fa-solid fa-trash'></i> Eliminar</a>
                            </td>
                        <tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <!-- inlusión del archivo donde está el elemento emergente del botón -->
        <?php
        include 'nuevoClienteModal.php';
        include 'editarClienteModal.php';
        include 'eliminarClienteModal.php';
        ?>

        <!-- evento para visualizar y ocultar -->
        <script>
            // # limpiar datos
            let nuevoClienteModal = document.getElementById('nuevoClienteModal')
            // # editar el cliente
            let editarClienteModal = document.getElementById('editarClienteModal')
            // # eliminar el cliente
            let eliminarClienteModal = document.getElementById('eliminarClienteModal')

            // ## Evento para limpiar datos
            nuevoClienteModal.addEventListener('hide.bs.modal', event => {})

            // ## Evento para editar datos
            editarClienteModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')
                // # para saber qué elemento debe ser editado # definido en editarClienteModal.php (div)
                let inputId = editarClienteModal.querySelector('.modal-body #idCliente')
                let inputNombre = editarClienteModal.querySelector('.modal-body #nombre')
                let inputApellidos = editarClienteModal.querySelector('.modal-body #apellidos')
                let inputEmail = editarClienteModal.querySelector('.modal-body #email')
                let inputTelefono = editarClienteModal.querySelector('.modal-body #telefono')
                let inputDireccion = editarClienteModal.querySelector('.modal-body #direccion')
                let inputComentarios = editarClienteModal.querySelector('.modal-body #comentarios')

                // Petición AJAX
                let url = "seleccionarCliente.php"
                let formData = new FormData()
                formData.append('idCliente', id)

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
                    .catch(err => console.log(err))
            })

            // ## Evento para Eliminar ##
            eliminarClienteModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')

                eliminarClienteModal.querySelector('.modal-footer #idCliente').value = id
            })
        </script>

    </div>

    <script src="/proyectoWT/assets/js/bootstrap.bundle.min.js"></script>
<!-- </body>

</html> -->