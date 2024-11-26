<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Home | WorkTrack</title>
  <!-- Favicons -->
  <link rel="icon" href="../assets/img/Logo_WT.png" type="image/png" />
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <!-- FONTAWESOME & BOOTSTRAP -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/all.min.css" />
</head>
<!--  -->
<style>
  body {
    font-family: 'Montserrat';
    background-color: #f8f9fa;
  }

  .bg-gradient-primary {
    background: linear-gradient(to top, #007bff 0%, #0056b3 100%);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
  }

  .bg-primary-footer {
    background: linear-gradient(to bottom, #007bff 0%, #0056b3 100%);
    box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.3);
  }

  .table {
    font-family: 'Lucida Sans';
  }
</style>


<header class="navbar navbar-expand-md navbar-dark bd-navbar sticky-top bg-gradient-primary">
  <div class="container-fluid">
    <div class="d-flex align-items-center">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../../adminHome.php">
        <img src="../../assets/img/Logo_WT.png" alt="Logo WorkTrack" width="60" height="60" class="d-inline-block" />
        Inicio
      </a>
    </div>

    <div class="collapse navbar-collapse justify-content-center" id="navbarToggler">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="../clientes/clientes.php">
            <i class="fa-solid fa-briefcase"></i>
            Clientes
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="../proyectos/proyectos.php">
            <i class="fa-solid fa-city"></i>
            Proyectos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="../usuarios/usuarios.php">
            <i class="fa-solid fa-users"></i>
            Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="../partes/partes.php">
            <i class="fa-solid fa-calendar-days"></i>
            Partes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex flex-column align-items-center text-white" href="../horas/horas.php">
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
            <a href="../../cierreSesion.php" class="dropdown-item">
              <i class="fa-solid fa-right-from-bracket"></i>
              <span class="ms-2">Cerrar sesión</span></a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</header>

<!-- FIN Header -->