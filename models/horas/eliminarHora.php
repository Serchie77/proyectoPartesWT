<?php
session_start();
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idParteHora = filter_input(INPUT_POST, 'idParteHora', FILTER_SANITIZE_NUMBER_INT);

try {
    // Preparación y ejecución de la eliminación
    $eliminarRegistro = $conexionbd->prepare("DELETE FROM parteshoras WHERE idParteHora = :idParteHora");
    $eliminarRegistro->bindParam(':idParteHora', $idParteHora);
    $resultado = $eliminarRegistro->execute();

    // Manejo del resultado
    if ($resultado) {
        $_SESSION['color'] = "success";
        $_SESSION['mensaje'] = "Registro eliminado correctamente.";
    } else {
        $_SESSION['color'] = "danger";
        $_SESSION["mensaje"] = "Error al eliminar el registro.";
    }
} catch (PDOException $e) {
    $_SESSION['color'] = "danger";
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

header('Location: /proyectoWT/models/horas/horas.php');
exit();
