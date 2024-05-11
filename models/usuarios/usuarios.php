<!-- Recuperamos la conexión BD -->
<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// # Traer los registros de la tabla
$consultaCliente = $conexionbd->prepare("SELECT * FROM usuarios");
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
    <title>CRUD</title>

    <link rel="stylesheet" href="/proyectoWT/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyectoWT/assets/css/all.min.css">
</head>

<body>
    <!-- contenedor principal Clientes-->
    <div class="container py-3">

        <h2 class="text-center">Usuarios</h2>
        <hr>
    </div>
    <script src="/proyectoWT/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>