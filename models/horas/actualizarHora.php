<!-- INSERTA CLIENTES NUEVOS -->
<?php
// Inicio de sesión
session_start();
// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idParteHora = filter_input(INPUT_POST, 'idParteHora', FILTER_SANITIZE_STRING);
$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
$horasNormales = filter_input(INPUT_POST, 'horasNormales', FILTER_SANITIZE_STRING);
$horasExtras = filter_input(INPUT_POST, 'horasExtras', FILTER_SANITIZE_STRING);
$idParte = filter_input(INPUT_POST, 'idParte', FILTER_SANITIZE_STRING);
$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_STRING);

// Preparación y ejecución de la consulta de inserción
$actualizarRegistro = $conexionbd->prepare("UPDATE partesHoras SET fecha = :fecha, horasNormales = :horasNormales, horasExtras = :horasExtras, idParte = :idParte, idUsuario = :idUsuario WHERE idParteHora = :idParteHora");

// Enlaces de parámetros
$actualizarRegistro->bindParam(':idParteHora', $idParteHora);
$actualizarRegistro->bindParam(':fecha', $fecha);
$actualizarRegistro->bindParam(':horasNormales', $horasNormales);
$actualizarRegistro->bindParam(':horasExtras', $horasExtras);
$actualizarRegistro->bindParam(':idParte', $idParte);
$actualizarRegistro->bindParam(':idUsuario', $idUsuario);

$resultado = $actualizarRegistro->execute();

// Manejo del resultado
if ($resultado) {
    $_SESSION['color'] = "success";
    $_SESSION['mensaje'] = "Registro actualizado";
} else {
    $_SESSION['color'] = "danger";
    $_SESSION["mensaje"] = "Error al actualizar registro";
}
header('Location: horas.php');
?>
