<?php
// -- # ELIMINA usuario # --

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_STRING);

// Consulta base de datos
$consulta = $conexionbd->prepare("SELECT * FROM usuarios WHERE idUsuario = :idUsuario LIMIT 1");
$consulta->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
$consulta->execute();

$usuario = [];

if ($consulta->rowCount() > 0) {
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
}

// Devolver respuesta como JSON
header('Content-Type: application/json');
// Evita que la respuesta se almacene en caché
header( 'Cache-Control: no-cache, must-revalidate' );

echo json_encode($usuario, JSON_UNESCAPED_UNICODE);
?>
