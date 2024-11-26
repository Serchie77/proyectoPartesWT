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
    $lugar = filter_input(INPUT_POST, 'lugar', FILTER_SANITIZE_STRING);
    $fechaInicio = filter_input(INPUT_POST, 'fechaInicio', FILTER_SANITIZE_EMAIL);
    $fechaFin = filter_input(INPUT_POST, 'fechaFin', FILTER_SANITIZE_STRING);
    $idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_STRING);

    // Preparación de la consulta
    $insertarProyecto = $conexionbd->prepare("INSERT INTO proyectos VALUES (:idProyecto, :nombre, :lugar, :fechaInicio, :fechaFin, :idCliente)");
    // # Enlaces de parámetros
    $insertarProyecto->bindParam(':idProyecto', $idProyecto);
    $insertarProyecto->bindParam(':nombre', $nombre);
    $insertarProyecto->bindParam(':lugar', $lugar);
    $insertarProyecto->bindParam(':fechaInicio', $fechaInicio);
    $insertarProyecto->bindParam(':fechaFin', $fechaFin);
    $insertarProyecto->bindParam(':idCliente', $idCliente);
    // # Ejecución de la consulta
    $resultado = $insertarProyecto->execute();

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

header('Location: proyectos.php');
exit();
