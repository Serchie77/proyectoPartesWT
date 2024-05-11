<!-- ELIMINA CLIENTE -->
<?php
// Inicio de sesión
session_start();
// Conexión a la base de datos
require '../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Recogida de datos del formulario y saneamiento
$idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_STRING);

// Preparación y ejecución de la eliminación
$eliminarRegistro = $conexionbd->prepare("DELETE FROM clientes WHERE idCliente = :idCliente");
$eliminarRegistro->bindParam(':idCliente', $idCliente);
$resultado = $eliminarRegistro->execute();


// Manejo del resultado
if ($resultado) {
   // $id = $conexionbd->lastInsertId();
      // Mensaje de actualizado correctamente
      $_SESSION['color'] = "success";
      $_SESSION['mensaje'] = "Registro eliminado";
} else {
   $_SESSION['color'] = "danger";
   $_SESSION["mensaje"] = "Error al eliminar registro";
}
header('Location: clientes.php');

?>