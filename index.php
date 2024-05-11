<?php

// Inicia la sesión
require_once 'sesion.php';

// Procesa el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar credenciales y establecer la sesión si son válidas
    
    // Después de establecer la sesión, redirigir según el rol
    if ($_SESSION['rol'] == 1) {
        header('Location: adminHome.php');
        exit();
    } elseif ($_SESSION['rol'] == 2) {
        header('Location: userHome.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT | Inicio de sesión</title>
    <!-- Favicons -->
    <link rel="icon" href="assets/img/Logo_WT.png" type="image/png">
    <!-- FONTAWESOME & BOOTSTRAP -->
    <link rel="stylesheet" href="estilos.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Saira:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <link rel="stylesheet" href="assets/css/all.min.css">

    <body>
        <form action="sesion.php" method="POST" id="form">
            <div class="form">
                <img class="logo" src="assets/img/Logo_WT.png" alt="logo WorkTrack">
                <h2>Bienvenidos a WorkTrack</h2>
                <!-- DIV ERROR -->
                <?php if (isset($_GET['error'])) { ?>
                    <div class="error" id="mensajeError">
                        <?php echo $_GET['error'] ?>
                    </div>

                <?php } ?>

                <div class="grupo">
                    <input type="text" id="usuario" name="usuario" required="true" maxlength="15" minlength="8" autocomplete="username"><span class="barra"></span>
                    <label for=""><i class="fa-solid fa-user"></i> Usuario</label>
                </div>
                <div class="grupo">
                    <input type="password" id="password" name="password" required="true" maxlength="15" minlength="8" autocomplete="current-password"><span class="barra"></span>
                    <label for=""><i class="fa-solid fa-lock"></i> Contraseña</label>
                </div>
                <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Entrar
                </button>
                <br>
                <p><a href="#">Solicita aquí sus credenciales</a></p>
            </div>
        </form>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            let usuario = document.getElementById("usuario");
            let password = document.getElementById("password");
            let mensajeError = document.getElementById("mensajeError");

            if (mensajeError) {
                usuario.addEventListener("click", clearErrorMessage);
                password.addEventListener("click", clearErrorMessage);
            }

            function clearErrorMessage() {
                if (mensajeError) {
                    mensajeError.innerHTML = '';
                    mensajeError.style.display = 'none';
                }
            }
        });
        </script>

    </body>

</html>