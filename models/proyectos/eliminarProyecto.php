<?php
// Inicio de sesión
session_start();
// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Recogida de datos del formulario y saneamiento
$idProyecto = filter_input(INPUT_POST, 'idProyecto', FILTER_VALIDATE_INT);
try {
   // Preparación y ejecución de la eliminación
   $eliminarRegistro = $conexionbd->prepare("DELETE FROM proyectos WHERE idProyecto = :idProyecto");
   $eliminarRegistro->bindParam(':idProyecto', $idProyecto);
   $resultado = $eliminarRegistro->execute();
   // Manejo del resultado
   if ($resultado) {
      $_SESSION['color'] = "success";
      $_SESSION['mensaje'] = "Registro eliminado";
   } else {
      $_SESSION['color'] = "danger";
      $_SESSION['mensaje'] = "Error al eliminar registro";
   }
} catch (PDOException $e) {
   $_SESSION['color'] = "danger";
   $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

header('Location: /proyectoWT/models/proyectos/proyectos.php');
exit();
