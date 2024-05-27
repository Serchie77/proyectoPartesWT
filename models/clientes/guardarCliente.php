<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Recogida de datos del formulario y saneamiento
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
    $comentarios = filter_input(INPUT_POST, 'comentarios', FILTER_SANITIZE_STRING);

    // Preparación de la consulta
    $insertarRegistro = $conexionbd->prepare("INSERT INTO clientes (nombre, apellidos, email, telefono, direccion, comentarios) VALUES (:nombre, :apellidos, :email, :telefono, :direccion, :comentarios)");
    
    // Enlaces de parámetros
    $insertarRegistro->bindParam(':nombre', $nombre);
    $insertarRegistro->bindParam(':apellidos', $apellidos);
    $insertarRegistro->bindParam(':email', $email);
    $insertarRegistro->bindParam(':telefono', $telefono);
    $insertarRegistro->bindParam(':direccion', $direccion);
    $insertarRegistro->bindParam(':comentarios', $comentarios);

    // Ejecución de la consulta
    $resultado = $insertarRegistro->execute();

    // Manejo del resultado
    if ($resultado) {
        $id = $conexionbd->lastInsertId();
        // Mensaje de guardado correctamente
        $_SESSION['color'] = "success";
        $_SESSION['mensaje'] = "Registro guardado";
    } else {
        $_SESSION['color'] = "danger";
        $_SESSION['mensaje'] = "Error al guardar el registro";
    }

} catch (PDOException $e) {
    $_SESSION['color'] = "danger";
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

// Redirigir a adminHome.php con una variable de sesión indicando que se debe cargar la sección de clientes
// $_SESSION['ultimaSeccion'] = 'clientes';
header('Location: /proyectoWT/models/clientes/clientes.php');
exit();
