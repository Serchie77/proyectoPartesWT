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
<!-- 
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Página de Inicio</title>

    <link rel="stylesheet" href="/proyectoWT/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyectoWT/assets/css/all.min.css">
</head>

<body> -->
    <!-- contenedor principal INICIO-->
    <div class="container py-3">

        <h4 class="text-center">Estás en la página de inicio donde se ven todos los proyectos, partes, etc.</h4>
        <hr>
    </div>
    <script src="/proyectoWT/assets/js/bootstrap.bundle.min.js"></script>
<!-- </body>

</html> -->