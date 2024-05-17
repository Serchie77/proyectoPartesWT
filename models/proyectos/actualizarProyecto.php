<!-- INSERTA CLIENTES NUEVOS -->
<?php
// Inicio de sesión
session_start();
// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Recogida de datos del formulario y saneamiento
$idProyecto = filter_input(INPUT_POST, 'idProyecto', FILTER_SANITIZE_STRING);
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$lugar = filter_input(INPUT_POST, 'lugar', FILTER_SANITIZE_STRING);
$fechaInicio = filter_input(INPUT_POST, 'fechaInicio', FILTER_SANITIZE_STRING);
$fechaFin = filter_input(INPUT_POST, 'fechaFin', FILTER_SANITIZE_STRING);
$idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_STRING);

// Preparación y ejecución de la consulta de inserción
$actualizarRegistro = $conexionbd->prepare("UPDATE proyectos SET nombre = :nombre, lugar = :lugar, fechaInicio = :fechaInicio, fechaFin = :fechaFin, idCliente = :idCliente WHERE idProyecto = :idProyecto");
$actualizarRegistro->bindParam(':nombre', $nombre);
$actualizarRegistro->bindParam(':lugar', $lugar);
$actualizarRegistro->bindParam(':fechaInicio', $fechaInicio);
$actualizarRegistro->bindParam(':fechaFin', $fechaFin);
$actualizarRegistro->bindParam(':idCliente', $idCliente);
$actualizarRegistro->bindParam(':idProyecto', $idProyecto);
$resultado = $actualizarRegistro->execute();

// Manejo del resultado
if ($resultado) {
    // $id = $conexionbd->lastInsertId();
    // Mensaje de actualizado correctamente
    $_SESSION['color'] = "success";
    $_SESSION['mensaje'] = "Registro actualizado";
} else {
    $_SESSION['color'] = "danger";
    $_SESSION["mensaje"] = "Error al actualizar registro";
}
header('Location: proyectos.php');

?>