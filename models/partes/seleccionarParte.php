<?php
// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idParte = filter_input(INPUT_POST, 'idParte', FILTER_SANITIZE_NUMBER_INT);

// Consulta base de datos
try {
    $consulta = $conexionbd->prepare("SELECT * FROM partes WHERE idParte = :idParte LIMIT 1");
    $consulta->bindParam(':idParte', $idParte, PDO::PARAM_INT);
    $consulta->execute();

    $partes = [];

    if ($consulta->rowCount() > 0) {
        $partes = $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Devolver respuesta como JSON
    header('Content-Type: application/json');
    // Evita que la respuesta se almacene en caché
    header('Cache-Control: no-cache, must-revalidate');

    echo json_encode($partes, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    // Manejo de errores
    echo json_encode(['error' => 'Error al ejecutar la consulta: ' . $e->getMessage()]);
}
