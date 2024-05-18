<?php
// -- # ELIMINA CLIENTE # --

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_STRING);

// Consulta base de datos
$consulta = $conexionbd->prepare("SELECT * FROM clientes WHERE idCliente = :idCliente LIMIT 1");
$consulta->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
$consulta->execute();

$cliente = [];

if ($consulta->rowCount() > 0) {
    $cliente = $consulta->fetch(PDO::FETCH_ASSOC);
}

// Devolver respuesta como JSON
header('Content-Type: application/json');
// Evita que la respuesta se almacene en caché
header( 'Cache-Control: no-cache, must-revalidate' );

echo json_encode($cliente, JSON_UNESCAPED_UNICODE);
?>
