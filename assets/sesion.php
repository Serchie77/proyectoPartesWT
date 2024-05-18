<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
include_once 'config/conexion.php';


if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Hash de la contraseña ingresada (esto es para registro, no para login)
    $passwordSHA = hash('sha256', $password);

    // Preparar la consulta con parámetros
    $consultaUsuarios = $conexionbd->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password");
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

        switch ($_SESSION['rol']) {
            case 1:
                header('Location: adminHome.php');
                exit();
            case 2:
                header('Location: userHome.php');
                exit();
            default:
        }
    } else {
        // # Error de validación
        // alerta();
        // echo 'El usuario o contraseña no son válidos';
        header('Location: index.php?error=Datos incorrectos');
        exit();
    }
}
?>
