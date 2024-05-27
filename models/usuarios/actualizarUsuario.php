<?php
// Inicio de sesión
session_start();
// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$idRol = filter_input(INPUT_POST, 'idRol', FILTER_VALIDATE_INT);

// Generar el hash SHA-256 de la nueva contraseña
$passwordSHA = hash('sha256', $password);

try {
    // Preparación y ejecución de la consulta de actualización
    $actualizarRegistro = $conexionbd->prepare("UPDATE usuarios SET 
    nombre = :nombre, 
    apellidos = :apellidos, 
    direccion = :direccion, 
    telefono = :telefono,
    email = :email, 
    usuario = :usuario, 
    password = :password, 
    idRol = :idRol 
    WHERE idUsuario = :idUsuario");

    // Enlaces de parámetros
    $actualizarRegistro->bindParam(':idUsuario', $idUsuario);
    $actualizarRegistro->bindParam(':nombre', $nombre);
    $actualizarRegistro->bindParam(':apellidos', $apellidos);
    $actualizarRegistro->bindParam(':direccion', $direccion);
    $actualizarRegistro->bindParam(':telefono', $telefono);
    $actualizarRegistro->bindParam(':email', $email);
    $actualizarRegistro->bindParam(':usuario', $usuario);
    $actualizarRegistro->bindParam(':password', $passwordSHA); // Utilizar el hash de la contraseña
    $actualizarRegistro->bindParam(':idRol', $idRol);

    $resultado = $actualizarRegistro->execute();

    // Manejo del resultado
    if ($resultado) {
        $_SESSION['color'] = "success";
        $_SESSION['mensaje'] = "Registro actualizado";
    } else {
        $_SESSION['color'] = "danger";
        $_SESSION["mensaje"] = "Error al actualizar registro";
    }
} catch (PDOException $e) {
    $_SESSION['color'] = "danger";
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

header('Location: /proyectoWT/models/usuarios/usuarios.php');
exit();
