<?php


require 'sesion.php';
require 'config/conexion.php';
require 'consultaDatos.php';

if (!isset($_SESSION['rol'])) {
  header('Location: index.php');
  exit();
}
// Obtener el usuario mediante sesión
$usuario = $_SESSION['usuario'];
// Obtener el ID del usuario logueado
$idUsuario = $_SESSION['idUsuario'];

// Obtener las cantidades totales de Clientes, Proyectos, Usuarios, etc
$cantidadClientes = contarClientes($conexionbd);
$cantidadProyectos = contarProyectos($conexionbd);
$cantidadUsuarios = contarUsuarios($conexionbd);
$cantidadPartes = contarPartes($conexionbd);
$cantidadHoras = contarHoras($conexionbd);

$trabajadoresProyectos = obtenerProyectosConTrabajadores($conexionbd);


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="Autor" content="Sergio Martínez" />
  <meta name="Description" content="Elaboración de partes de trabajo para una empresa" />
  <meta name="keywords" content="HTML, CSS, PHP, JavaScript" />
  <title>Admin Home | WorkTrack</title>
  <!-- Favicons -->
  <link rel="icon" href="assets/img/Logo_WT.png" type="image/png" />
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Saira:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <!-- FONTAWESOME & BOOTSTRAP -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/all.min.css" />
</head>
<!--  -->
<style>
    body {
      font-family: 'Montserrat';
      background: url(assets/img/photorealistic-style-clouds-city.jpg) bottom fixed;
      background-size: cover;
    }

  .bg-gradient-primary {
    background: linear-gradient(to top, #007bff 0%, #0056b3 100%);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
  }

  .bg-primary-footer {
    background: linear-gradient(to bottom, #007bff 0%, #0056b3 100%);
    box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.3);
  }

</style>


<body>
  <header class="navbar navbar-expand-md navbar-dark bd-navbar sticky-top bg-gradient-primary">
    <div class="container-fluid">
      <div class="d-flex align-items-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="adminHome.php">
          <img src="assets/img/Logo_WT.png" alt="Logo WorkTrack" width="60" height="60" class="d-inline-block" />
          Inicio
        </a>
      </div>

      <div class="collapse navbar-collapse justify-content-center" id="navbarToggler">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="models/clientes/clientes.php">
            <i class="fa-solid fa-briefcase"></i>
            Clientes
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="models/proyectos/proyectos.php">
            <i class="fa-solid fa-city"></i>
            Proyectos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="models/usuarios/usuarios.php">
            <i class="fa-solid fa-users"></i>
            Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="models/partes/partes.php">
            <i class="fa-solid fa-calendar-days"></i>
            Partes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="models/horas/horas.php">
            <i class="fa-solid fa-clock"></i>
            Horas</a>
        </li>
      </ul>
    </div>

      <ul class="navbar-nav">
        <li class="nav-item dropdown" data-bs-theme="light">
          <a class="nav-link text-white d-flex flex-column align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fa-stack">
              <i class="fas fa-circle fa-stack-2x"></i>
              <i class="fa-solid fa-user fa-stack-1x fa-inverse text-primary"></i>
            </span>

            <?php echo $_SESSION['usuario'] ?>
          </a>

          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a href="#" class="dropdown-item">
                <i class="fa-solid fa-user"></i>
                <span class="ms-2">Ver Perfil</span>
              </a>
            </li>
            <li>
              <a href="#" class="dropdown-item">
                <i class="fa-solid fa-wrench"></i>
                <span class="ms-2">Ajustes</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li>
              <a href="cierreSesion.php" class="dropdown-item">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="ms-2">Cerrar sesión</span></a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </header>

  <!-- FIN Header -->

  <!-- Div con las cards de inicio -->
  <div id="cards-inicio" class="container py-3">

    <div class="row g-2 py-3">
      <!-- Tarjeta CLIENTES -->
      <div class="col-md-4">
        <div class="card mb-4 shadow-lg text-bg-primary">
          <div class="card-body d-flex align-items-center">
            <i class="fa-solid fa-briefcase fa-3x me-3"></i>
            <div class="flex-grow-1 text-end">
              <h4><?php echo $cantidadClientes ?></h4>
              <p class="card-text">clientes</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Tarjeta PROYECTOS -->
      <div class="col-md-4">
        <div class="card mb-4 shadow-lg text-bg-success">
          <div class="card-body d-flex align-items-center">
            <i class="fa-solid fa-city fa-3x"></i>
            <div class="flex-grow-1 text-end">
              <h4><?php echo $cantidadProyectos ?></h4>
              <p class="card-text">proyectos</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Tarjeta USUARIOS -->
      <div class="col-md-4">
        <div class="card mb-4 shadow-lg text-bg-danger">
          <div class="card-body d-flex align-items-center">
            <i class="fa-solid fa-users fa-3x"></i>
            <div class="flex-grow-1 text-end">
              <h4><?php echo $cantidadUsuarios ?></h4>
              <p class="card-text">trabajadores activos</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Tarjeta PARTES -->
      <div class="col-md-6">
        <div class="card mb-4 shadow-lg text-bg-info text-light">
          <div class="card-body d-flex align-items-center">
            <i class="fa-solid fa-calendar-days fa-3x"></i>
            <div class="flex-grow-1 text-end">
              <h4><?php echo $cantidadPartes ?></h4>
              <p class="card-text">partes realizados</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Tarjeta HORAS -->
      <div class="col-md-6">
        <div class="card mb-4 shadow-lg bg-warning text-light">
          <div class="card-body d-flex align-items-center">
            <i class="fa-solid fa-clock fa-3x"></i>
            <div class="flex-grow-1 text-end">
              <h4><?php echo $cantidadHoras ?></h4>
              <p class="card-text">total horas normales</p>
            </div>
          </div>
        </div>
      </div>

    </div>

<!-- Tarjetas sobre Proyectos -->
<div class="col-md-5" style="font-size: 0.9em;">
  <div class="card border-success mb-4 shadow-lg">
    <div class="card-header bg-success d-flex align-items-end text-light">
      <span class="fa-stack fa-2x">
        <i class="fas fa-circle fa-stack-2x"></i>
        <i class="fa-solid fa-person-digging fa-stack-1x fa-inverse text-success"></i>
      </span>
      <div class="flex-grow-1 text-end">
        <h4>Proyectos en curso</h4>
      </div>
    </div>

    <?php
    // Iterar sobre los resultados y mostrar tarjetas
    foreach ($trabajadoresProyectos as $index => $proyecto) {
        $nombreProyecto = htmlspecialchars($proyecto['nombreProyecto']);
        $fechaInicio = htmlspecialchars($proyecto['fechaInicio']);
        $fechaFin = htmlspecialchars($proyecto['fechaFin']);
        $trabajadores = htmlspecialchars($proyecto['trabajadores']);
        $totalHorasNormales = htmlspecialchars($proyecto['totalHorasNormales']);
        $totalHorasExtras = htmlspecialchars($proyecto['totalHorasExtras']);

        // Verificar si hay trabajadores asociados al proyecto
        if (!empty($trabajadores)) {
            $trabajadoresString = $trabajadores;
        } else {
            $trabajadoresString = "Sin trabajadores asignados";
        }

        // Mostrar una línea divisoria entre los proyectos
        if ($index > 0) {
            echo '<hr>';
        }

        // Mostrar tarjeta
        echo "
        <div class='card-body d-flex align-items-center'>
            <div class='flex-grow-1 text-start'>
                <h4 class='text-success'>$nombreProyecto</h4>
                <div class='card-text d-flex'>
                  <div class='flex-grow-1 d-flex align-items-center'>
                    <p class='card-text'><strong>Fecha de Inicio: </strong>$fechaInicio</p>
                  </div>
                  <div class='flex-grow-1 d-flex align-items-center justify-content-end'>
                    <p class='card-text'><strong>Fecha de Fin: </strong>$fechaFin</p>
                  </div>
                </div>
                <p class='card-text'><strong>Trabajadores: </strong>$trabajadoresString</p>
                <p class='card-text'><strong>Total Horas Normales: </strong>$totalHorasNormales</p>
                <p class='card-text'><strong>Total Horas Extras: </strong>$totalHorasExtras</p>
            </div>
        </div>";
    }
    ?>
  </div>
</div>


    <!-- Tarjetas sobre Partes -->


  </div>

  <!-- footer -->
  <footer class="footer fixed-bottom bg-primary-footer text-white">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <p>© WorkTrack 2024 | Todos los Derechos Reservados</p>
        </div>
        <div class="col-sm-6">
          <ul class="list-inline text-sm-end text-white">
            <li class="list-inline-item">
              <a class="nav-link" href="mailto:semaro1977@gmail.com" target="_blank" rel="nooper noreferrer">
                Contacta con nosotros <i class="fa-regular fa-envelope"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="nav-link" href="#"><i class="fa-brands fa-whatsapp"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="nav-link" href="#"><i class="fa-brands fa-facebook"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="nav-link" href="#"><i class="fa-brands fa-instagram"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="nav-link" href="#"><i class="fa-brands fa-x-twitter"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="nav-link" href="#">· Política de privacidad</a>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </footer>

<!-- Enlace a los archivos JS de Bootstrap -->
<script src="assets/js/bootstrap.bundle.min.js"> </script>

</body>

</html>