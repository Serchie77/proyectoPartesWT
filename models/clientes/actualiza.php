<!-- INSERTA CLIENTES NUEVOS -->
<?php
// Inicio de sesión
session_start();
// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Recogida de datos del formulario y saneamiento
$idCliente = filter_input(INPUT_POST, 'idCliente', FILTER_SANITIZE_STRING);
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
$comentarios = filter_input(INPUT_POST, 'comentarios', FILTER_SANITIZE_STRING);

// Preparación y ejecución de la consulta de inserción
$actualizarRegistro = $conexionbd->prepare("UPDATE clientes SET nombre = :nombre, apellidos = :apellidos, email = :email, telefono = :telefono, direccion = :direccion, comentarios = :comentarios WHERE idCliente = :idCliente");
$actualizarRegistro->bindParam(':nombre', $nombre);
$actualizarRegistro->bindParam(':apellidos', $apellidos);
$actualizarRegistro->bindParam(':email', $email);
$actualizarRegistro->bindParam(':telefono', $telefono);
$actualizarRegistro->bindParam(':direccion', $direccion);
$actualizarRegistro->bindParam(':comentarios', $comentarios);
$actualizarRegistro->bindParam(':idCliente', $idCliente);
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
header('Location: clientes.php');

?>