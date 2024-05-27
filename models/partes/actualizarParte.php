<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idParte = filter_input(INPUT_POST, 'idParte', FILTER_SANITIZE_NUMBER_INT);
$fechaInicio = filter_input(INPUT_POST, 'fechaInicio', FILTER_SANITIZE_STRING);
$fechaFin = filter_input(INPUT_POST, 'fechaFin', FILTER_SANITIZE_STRING);
$totalHorasNormales = filter_input(INPUT_POST, 'totalHorasNormales', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$totalHorasExtras = filter_input(INPUT_POST, 'totalHorasExtras', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$horasViaje = filter_input(INPUT_POST, 'horasViaje', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$comentarios = filter_input(INPUT_POST, 'comentarios', FILTER_SANITIZE_STRING);
$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_NUMBER_INT);
$idProyecto = filter_input(INPUT_POST, 'idProyecto', FILTER_SANITIZE_NUMBER_INT);

try {
    // Preparación y ejecución de la consulta de actualización
    $actualizarRegistro = $conexionbd->prepare("UPDATE partes 
        SET fechaInicio = :fechaInicio, fechaFin = :fechaFin, totalHorasNormales = :totalHorasNormales, 
        totalHorasExtras = :totalHorasExtras, horasViaje = :horasViaje, comentarios = :comentarios, 
        idUsuario = :idUsuario, idProyecto = :idProyecto
        WHERE idParte = :idParte");

    // Enlaces de parámetros
    $actualizarRegistro->bindParam(':idParte', $idParte);
    $actualizarRegistro->bindParam(':fechaInicio', $fechaInicio);
    $actualizarRegistro->bindParam(':fechaFin', $fechaFin);
    $actualizarRegistro->bindParam(':totalHorasNormales', $totalHorasNormales);
    $actualizarRegistro->bindParam(':totalHorasExtras', $totalHorasExtras);
    $actualizarRegistro->bindParam(':horasViaje', $horasViaje);
    $actualizarRegistro->bindParam(':comentarios', $comentarios);
    $actualizarRegistro->bindParam(':idUsuario', $idUsuario);
    $actualizarRegistro->bindParam(':idProyecto', $idProyecto);

    // Ejecución de la consulta
    $resultado = $actualizarRegistro->execute();

    // Manejo del resultado
    if ($resultado) {
        $_SESSION['color'] = "success";
        $_SESSION['mensaje'] = "Registro actualizado correctamente.";
    } else {
        $_SESSION['color'] = "danger";
        $_SESSION['mensaje'] = "Error al actualizar el registro.";
    }
} catch (Exception $e) {
    $_SESSION['color'] = "danger";
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

header('Location: /proyectoWT/models/partes/partes.php');
exit();
