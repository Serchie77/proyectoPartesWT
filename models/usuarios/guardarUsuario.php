<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT); // Se hashea la contraseña
$idRol = filter_input(INPUT_POST, 'idRol', FILTER_SANITIZE_NUMBER_INT); // Se asegura de que el ID del rol sea un número entero

try {
    // Preparación de la consulta
    $insertarUsuario = $conexionbd->prepare("INSERT INTO usuarios (nombre, apellidos, direccion, telefono, email, usuario, password, idRol)
        VALUES (:nombre, :apellidos, :direccion, :telefono, :email, :usuario, :password, :idRol)");
    // Enlaces de parámetros
    $insertarUsuario->bindParam(':nombre', $nombre);
    $insertarUsuario->bindParam(':apellidos', $apellidos);
    $insertarUsuario->bindParam(':direccion', $direccion);
    $insertarUsuario->bindParam(':telefono', $telefono);
    $insertarUsuario->bindParam(':email', $email);
    $insertarUsuario->bindParam(':usuario', $usuario);
    $insertarUsuario->bindParam(':password', $password);
    $insertarUsuario->bindParam(':idRol', $idRol);
    // Ejecución de la consulta
    $resultado = $insertarUsuario->execute();

    // Manejo del resultado
    if ($resultado) {
        // Mensaje de guardado correctamente
        $_SESSION['color'] = "success";
        $_SESSION['mensaje'] = "Registro guardado";
    } else {
        throw new Exception("Error al guardar el usuario.");
    }
} catch (Exception $e) {
    // Manejo de errores
    $_SESSION['color'] = "danger";
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

header('Location: /proyectoWT/models/usuarios/usuarios.php');
exit();
