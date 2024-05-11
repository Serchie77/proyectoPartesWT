<?php

// session_start();
require_once 'sesion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header('Location: index.php');
    exit();
}
// Obtener el usuario mediante sesión
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- metadatos -->
    <meta name="Autor" content="Sergio Martínez">
    <meta name="Description" content="Elaboración de partes de trabajo para una empresa">
    <meta name="keywords" content="HTML, CSS, PHP, JavaScript">

    <title>Partes 2024 | WorkTrack</title>
    <!-- Favicons -->
    <link rel="icon" href="/proyectoWT/assets/img/Logo_WT.png" type="image/png">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Saira:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="../assets/css/bootswatch-materia/bootstrap.min.css"> -->
    <link rel="stylesheet" href="/proyectoWT/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyectoWT/assets/css/all.min.css">
</head>
<script>
    // ## Función para cargar el contenido de INICIO
    function cargarContenidoInicio() {
        // # Realizar una solicitud AJAX para obtener el contenido de la página de inicio
        fetch('./models/panel/inicio.php')
            .then(response => response.text())
            .then(data => {
                // Insertar el contenido en el contenedor dinámico
                document.getElementById('contenido-dinamico').innerHTML = data;
            })
            .catch(error => console.error('Error al cargar el contenido de la página de inicio:', error));
    }

    // ## Función para cargar el contenido CLIENTES
    function cargarContenidoClientes() {
        // Realizar una solicitud AJAX para obtener el contenido de la sección
        fetch('./models/clientes/clientes.php')
            .then(response => response.text())
            .then(data => {
                // Insertar el contenido en el contenedor dinámico
                document.getElementById('contenido-dinamico').innerHTML = data;
            })
            .catch(error => console.error('Error al cargar el contenido:', error));
    }


    // ## Función para cargar el contenido USURIOS
    function cargarContenidoUsuarios() {
        // Realizar una solicitud AJAX para obtener el contenido de la sección
        fetch(`./models/usuarios/usuarios.php`)
            .then(response => response.text())
            .then(data => {
                // Insertar el contenido en el contenedor dinámico
                document.getElementById('contenido-dinamico').innerHTML = data;
            })
            .catch(error => console.error('Error al cargar el contenido:', error));
    }
</script>

<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#" onclick="cargarContenidoInicio()">
                    <img src="/proyectoWT/assets/img/Logo_WT.png" alt="Logo WorkTrack" width="60" height="60" class="d-inline-block">
                    Inicio
                </a>
            </div>
            <!-- Colapsado en tamaño LG -->
            <div class="collapse navbar-collapse" id="navbarToggler">
                <!-- Zona Accesos a CRUD ADMIN -->
                <ul class="navbar-nav">
                    <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
                        <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                        <hr class="d-lg-none my-2 text-white-50">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="cargarContenidoClientes()">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="cargarContenidoUsuarios()">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Partes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Horas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Proyectos</a>
                    </li>
                </ul>
            </div>
            <!-- Gestión del Usuario -->
            <ul class="navbar-nav ms-md-auto">
                <li class="nav-item dropdown" data-bs-theme="light">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $usuario ?>
                    </a>
                    <ul class="dropdown-menu ">
                        <li>
                            <a href="#" class="dropdown-item d-flex align-items-start justify-content-between">
                                <span class="ms-2">Ver Perfil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="#" class="dropdown-item d-flex align-items-start justify-content-between">
                                <span class="ms-2">Ajustes</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
                        <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                        <hr class="d-lg-none my-2 text-white-50">
                    </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="cierreSesion.php">Cerrar Sesión</a>

                </li>
            </ul>

        </div>
        </div>
    </nav>

    <body>

        <center>
            <h1>Soy el administrador con usuario <?php echo $usuario ?></h1>

        </center>

        <!-- Contenedor para cargar el contenido dinámico ## Inclusión por defecto la página de inicio-->
        <div id="contenido-dinamico" class="container py-3">

            <?php include 'models/panel/inicio.php'; ?>

        </div>

        <footer class="footer fixed-bottom bg-primary text-white">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p>© WorkTrack 2024 | Todos los Derechos Reservados</p>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline text-sm-end text-white">
                            <li class="list-inline-item"><a class="nav-link" href="mailto:smarrod687a@isidrodearceneguiycarmona.es" target="_blank" rel="nooper noreferrer">
                                    Contacta con nosotros <i class="fa-regular fa-envelope"></i></a></li>
                            <li class="list-inline-item"><a class="nav-link" href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                            <li class="list-inline-item"><a class="nav-link" href="#"><i class="fa-brands fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="nav-link" href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="nav-link" href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="nav-link" href="#">· Política de privacidad</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- <script src="../assets/js/bootstrap.bundle.min.js"></script> -->



    </body>

</html>