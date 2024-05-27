<?php
// Inicio de sesión

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// ### Verificación de usuario autenticado # dan problemas las cookies
// if (!isset($_SESSION['usuario'])) {
//     header('Location: /proyectoWT/index.php');
//     exit();
// }

// Conexión a la base de datos
include_once 'config/conexion.php';


if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Hash de la contraseña ingresada (esto es para registro, no para login)
    $passwordSHA = hash('sha256', $password);

    // Preparar la consulta con parámetros
    $consultaUsuarios = $conexionbd->prepare("SELECT * FROM usuarios WHERE BINARY usuario = :usuario AND password = :password");
    $consultaUsuarios->bindParam(':usuario', $usuario);
    $consultaUsuarios->bindParam(':password', $passwordSHA);
    $consultaUsuarios->execute();

    $resultado = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);

    if ($resultado && $resultado['password'] === $passwordSHA) {
        // # Se valida el rol
        $rol = $resultado['idRol'];
        $_SESSION['rol'] = $rol;

        // ## Guardar el nombre de usuario para luego mostrarlo
        $_SESSION['usuario'] = $usuario;
        // ## Almacenar el ID del usuario en la sesión
        $_SESSION['idUsuario'] = $resultado['idUsuario'];

        switch ($_SESSION['rol']) {
            case 1:
                header('Location: adminHome.php');
                exit();
            case 2:
                header('Location: userHome.php');
                exit();
            default:
                header('Location: index.php?error=Rol no reconocido');
                exit();
        }
    } else {
        header('Location: index.php?error=Datos incorrectos');
        exit();
    }
}
