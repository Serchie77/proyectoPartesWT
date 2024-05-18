<!-- Recuperamos la conexión BD -->
<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// # Traer los registros para mostrarlos en la tabla juntandola con la tabla rol
$consultaUsuario = $conexionbd->prepare("SELECT usuarios.idUsuario, usuarios.nombre, usuarios.apellidos, usuarios.direccion, usuarios.telefono, usuarios.email, usuarios.usuario, usuarios.password, rol.rol AS rol
    FROM usuarios INNER JOIN rol ON usuarios.idRol = rol.idRol
");
$consultaUsuario->execute();
/*
// # Para mostrar la imagen o documento
$dir = "imagen/";
// # Faltaría incluir en la tabla el registro de la imagen en sí
*/

// ## Función para ocultar la contraseña
function ocultarPassword($password)
{
    return str_repeat('*', 8);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Usuarios</title>

    <link rel="stylesheet" href="/proyectoWT/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyectoWT/assets/css/all.min.css">
</head>

<body>
    <!-- contenedor principal usuarios-->

    <div class="container py-3">

        <div class="card text-bg-info mb-3">
            <span class="placeholder-wave col-12 placeholder-lg bg-info">
                <h2 class="card-header text-center text-light"><i class="fa-solid fa-users"></i></i> Usuarios</h2>
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
            <a href="#" class="btn btn-outline-success p-1" data-bs-toggle="modal" data-bs-target="#nuevoUsuarioModal"><i class="fa-solid fa-circle-plus"></i> Agregar Nuevo Usuario</a>
        </div>

        <!-- Tabla para mostrar datos usuarios -->
        <div class="table-responsive-sm">
            <table class="table table-sm table-over table-bordered mt-2" style="font-size: 0.8em;">
                <!-- cabecera de la Tabla -->
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>E-Mail</th>
                        <th>Alias</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <!-- cuerpo de la Tabla -->
                <tbody class="table-info">
                    <?php
                    while ($registro = $consultaUsuario->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                            <td class='table-dark' style='font-size: 0.9em;'>{$registro['idUsuario']}</td>
                            <td >{$registro['nombre']}</td>
                            <td >{$registro['apellidos']}</td>
                            <td >{$registro['direccion']}</td>
                            <td >{$registro['telefono']}</td>
                            <td >{$registro['email']}</td>
                            <td >{$registro['usuario']}</td>
                            <td >" . ocultarPassword($registro['password']) . "</td>
                            <td >{$registro['rol']}</td>

                            <td>
                                <a href='#' class='btn btn-sm btn-warning' data-bs-toggle='modal' 
                                data-bs-target='#editarUsuarioModal' data-bs-id='{$registro['idUsuario']}'> <i class='fa-solid fa-pen-to-square'></i> Editar</a> 
                        
                                <a href='#' class='btn btn-sm btn-danger' data-bs-toggle='modal' 
                                data-bs-target='#eliminarUsuarioModal' data-bs-id='{$registro['idUsuario']}'> <i class='fa-solid fa-trash'></i> Eliminar</a>
                            </td>
                        <tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <?php
        // # Traer el tipo de ROL al USUARIO 
        $consultaRol = $conexionbd->prepare("SELECT idRol, rol FROM rol");
        $consultaRol->execute();
        ?>

        <!-- inlusión del archivo donde está el elemento emergente del botón -->
        <?php
        include 'nuevoUsuarioModal.php';
        // Reinicio del fetch() para mostrar el nombre del ROL en editarUsuarioModal
        $consultaRol->execute();
        include 'editarUsuarioModal.php';
        include 'eliminarUsuarioModal.php';
        ?>

        <!-- evento para visualizar y ocultar -->
        <script>
            // # limpiar datos
            let nuevoUsuarioModal = document.getElementById('nuevoUsuarioModal')
            // # editar el cliente
            let editarUsuarioModal = document.getElementById('editarUsuarioModal')
            // # eliminar el cliente
            let eliminarUsuarioModal = document.getElementById('eliminarUsuarioModal')

            // ## Evento para limpiar datos
            nuevoUsuarioModal.addEventListener('hide.bs.modal', event => {})

            // ## Evento para editar datos
            editarUsuarioModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')
                // # para saber qué elemento debe ser editado # definido en editaModal.php (div)
                let inputId = editarUsuarioModal.querySelector('.modal-body #idUsuario')
                let inputNombre = editarUsuarioModal.querySelector('.modal-body #nombre')
                let inputApellidos = editarUsuarioModal.querySelector('.modal-body #apellidos')
                let inputDireccion = editarUsuarioModal.querySelector('.modal-body #direccion')
                let inputTelefono = editarUsuarioModal.querySelector('.modal-body #telefono')
                let inputEmail = editarUsuarioModal.querySelector('.modal-body #email')
                let inputUsuario = editarUsuarioModal.querySelector('.modal-body #usuario')
                let inputPassword = editarUsuarioModal.querySelector('.modal-body #password')
                let inputIdRol = editarUsuarioModal.querySelector('.modal-body #idRol')

                // Petición AJAX
                let url = "seleccionarUsuario.php"
                let formData = new FormData()
                formData.append('idUsuario', id)

                fetch(url, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        inputId.value = data.idUsuario;
                        inputNombre.value = data.nombre;
                        inputApellidos.value = data.apellidos;
                        inputDireccion.value = data.direccion;
                        inputTelefono.value = data.telefono;
                        inputEmail.value = data.email;
                        inputUsuario.value = data.usuario;
                        inputPassword.value = data.password;
                        inputIdRol.value = data.idRol;
                    })
                    .catch(err => console.log(err))
            })

            // ## Evento para Eliminar ##
            eliminarUsuarioModal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget
                // # botón detectado como id # definirlo en la referencia botón tabla anterior
                let id = button.getAttribute('data-bs-id')

                eliminaUsuarioModal.querySelector('.modal-footer #idUsuario').value = id
            })
        </script>

    </div>

    <script src="/proyectoWT/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>