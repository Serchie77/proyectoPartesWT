<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

try {
    // Configura PDO para lanzar excepciones cuando ocurra un error
    $conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recogida de datos del formulario y saneamiento
    $idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_NUMBER_INT);

    // Preparación y ejecución de la eliminación
    $eliminarRegistro = $conexionbd->prepare("DELETE FROM usuarios WHERE idUsuario = :idUsuario");
    $eliminarRegistro->bindParam(':idUsuario', $idUsuario);
    $resultado = $eliminarRegistro->execute();

    // Manejo del resultado
    if ($resultado) {
        $_SESSION['color'] = "success";
        $_SESSION['mensaje'] = "Registro eliminado";
    } else {
        $_SESSION['color'] = "danger";
        $_SESSION["mensaje"] = "Error al eliminar registro";
    }
} catch (Exception $e) {
    // Manejo de excepciones
    $_SESSION['color'] = "danger";
    $_SESSION["mensaje"] = "Error: " . $e->getMessage();
}

// Redirecciona a la página de usuarios
header('Location: usuarios.php');
exit();
