<?php
// -- # ELIMINA PROYECTO # --

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idProyecto = filter_input(INPUT_POST, 'idProyecto', FILTER_SANITIZE_STRING);

// Consulta base de datos
$consulta = $conexionbd->prepare("SELECT * FROM proyectos WHERE idProyecto = :idProyecto LIMIT 1");
$consulta->bindParam(':idProyecto', $idProyecto, PDO::PARAM_INT);
$consulta->execute();

$proyecto = [];

if ($consulta->rowCount() > 0) {
    $proyecto = $consulta->fetch(PDO::FETCH_ASSOC);
}

// Devolver respuesta como JSON
header('Content-Type: application/json');
// Evita que la respuesta se almacene en caché
header( 'Cache-Control: no-cache, must-revalidate' );

echo json_encode($proyecto, JSON_UNESCAPED_UNICODE);
?>
