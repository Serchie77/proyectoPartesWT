<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idParteHora = filter_input(INPUT_POST, 'idParteHora', FILTER_SANITIZE_NUMBER_INT);
$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
$horasNormales = filter_input(INPUT_POST, 'horasNormales', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$horasExtras = filter_input(INPUT_POST, 'horasExtras', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$idParte = filter_input(INPUT_POST, 'idParte', FILTER_SANITIZE_NUMBER_INT);
$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_NUMBER_INT);

try {
    // Preparación de la consulta
    $insertarHoras = $conexionbd->prepare("INSERT INTO partesHoras (idParteHora, fecha, horasNormales, horasExtras, idParte, idUsuario)
        VALUES (:idParteHora, :fecha, :horasNormales, :horasExtras, :idParte, :idUsuario)
    ");
    // Enlaces de parámetros
    $insertarHoras->bindParam(':idParteHora', $idParteHora);
    $insertarHoras->bindParam(':fecha', $fecha);
    $insertarHoras->bindParam(':horasNormales', $horasNormales);
    $insertarHoras->bindParam(':horasExtras', $horasExtras);
    $insertarHoras->bindParam(':idParte', $idParte);
    $insertarHoras->bindParam(':idUsuario', $idUsuario);

    // Ejecución de la consulta
    $resultado = $insertarHoras->execute();

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
} catch (Exception $e) {
    $_SESSION['color'] = "danger";
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

header('Location: horas.php');
exit();