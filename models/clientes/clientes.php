<!-- Recuperamos la conexión BD -->
<?php
// Inicio de sesión
// session_start();

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Clientes</title>

    <link rel="stylesheet" href="/proyectoWT/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyectoWT/assets/css/all.min.css">
</head>

<body>
    <!-- contenedor principal Clientes-->

    <div class="container py-3">

        <h2 class="text-center">Clientes</h2>

        <!-- Mensaje de advertencia -->
        <hr>
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

        <!-- contenedor de la Tabla -->
        <div class="row justify-content-start">
            <!-- botón con referencia -->
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i
                        class="fa-solid fa-circle-plus"></i> Nuevo Cliente</a>
            </div>
        </div>

        <!-- Tabla para mostrar datos Cliente -->
        <div class="table-responsive-sm">
            <table class="table table-sm table-striped table-over mt-4">
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
                                data-bs-target='#editaModal' data-bs-id='{$registro['idCliente']}'> <i class='fa-solid fa-pen-to-square'></i> Editar</a> 
                        
                                <a href='#' class='btn btn-sm btn-danger' data-bs-toggle='modal' 
                                data-bs-target='#eliminaModal' data-bs-id='{$registro['idCliente']}'> <i class='fa-solid fa-trash'></i> Eliminar</a>
                            </td>
                        <tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <!-- consulta de la tabla Clientes -->
        <?php
        // Preparar la consulta SQL
        $consulta = $conexionbd->prepare('SELECT * FROM clientes');
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        ?>

        <!-- inlusión del archivo donde está el elemento emergente del botón -->
        <?php
        include 'nuevoModal.php';
        include 'editaModal.php';
        include 'eliminaModal.php';
        ?>

        <!-- evento para visualizar y ocultar -->
        <script>
        // # limpiar datos
        let nuevoModal = document.getElementById('nuevoModal')
        // # editar el cliente
        let editaModal = document.getElementById('editaModal')
        // # eliminar el cliente
        let eliminaModal = document.getElementById('eliminaModal')

        // ## Evento para limpiar datos
        nuevoModal.addEventListener('hide.bs.modal', event => {

        })


        // ## Evento para editar datos
        editaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            // # botón detectado como id # definirlo en la referencia botón tabla anterior
            let id = button.getAttribute('data-bs-id')
            // # para saber qué elemento debe ser editado # definido en editaModal.php (div)
            let inputId = editaModal.querySelector('.modal-body #idCliente')
            let inputNombre = editaModal.querySelector('.modal-body #nombre')
            let inputApellidos = editaModal.querySelector('.modal-body #apellidos')
            let inputEmail = editaModal.querySelector('.modal-body #email')
            let inputTelefono = editaModal.querySelector('.modal-body #telefono')
            let inputDireccion = editaModal.querySelector('.modal-body #direccion')
            let inputComentarios = editaModal.querySelector('.modal-body #comentarios')

            // Petición AJAX
            let url = "getCliente.php"
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
        eliminaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            // # botón detectado como id # definirlo en la referencia botón tabla anterior
            let id = button.getAttribute('data-bs-id')

            eliminaModal.querySelector('.modal-footer #idCliente').value = id
        })
        </script>

    </div>

    <script src="/proyectoWT/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>