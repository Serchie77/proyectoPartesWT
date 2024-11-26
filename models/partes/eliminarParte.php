<?php
// Inicio de sesión
session_start();
// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idParte = filter_input(INPUT_POST, 'idParte', FILTER_SANITIZE_NUMBER_INT);
try {
   // Preparación y ejecución de la eliminación
   $eliminarRegistro = $conexionbd->prepare("DELETE FROM partes WHERE idParte = :idParte");
   $eliminarRegistro->bindParam(':idParte', $idParte);
   $resultado = $eliminarRegistro->execute();

   // Manejo del resultado
   if ($resultado) {
      $_SESSION['color'] = "success";
      $_SESSION['mensaje'] = "Registro eliminado";
   } else {
      $_SESSION['color'] = "danger";
      $_SESSION["mensaje"] = "Error al eliminar registro";
   }
} catch (PDOException $e) {
   $_SESSION['color'] = "danger";
   $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}
header('Location: partes.php');
exit();
