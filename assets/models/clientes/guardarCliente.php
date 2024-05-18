<!-- INSERTA CLIENTES NUEVOS -->
<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Recogida de datos del formulario y saneamiento
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
$comentarios = filter_input(INPUT_POST, 'comentarios', FILTER_SANITIZE_STRING);

// Preparación de la consulta
$insertarRegistro = $conexionbd->prepare("INSERT INTO clientes VALUES (:idCliente, :nombre, :apellidos, :email, :telefono, :direccion, :comentarios)");
// # Enlaces de parámetros
$insertarRegistro->bindParam(':idCliente', $idCliente);
$insertarRegistro->bindParam(':nombre', $nombre);
$insertarRegistro->bindParam(':apellidos', $apellidos);
$insertarRegistro->bindParam(':email', $email);
$insertarRegistro->bindParam(':telefono', $telefono);
$insertarRegistro->bindParam(':direccion', $direccion);
$insertarRegistro->bindParam(':comentarios', $comentarios);
// # Ejecución de la consulta
$resultado = $insertarRegistro->execute();

// Manejo del resultado
if ($resultado) {
    $id = $conexionbd->lastInsertId();
    // Mensaje de guardado correctamente
    $_SESSION['color'] = "success";
    $_SESSION['mensaje'] = "Registro guardado";

/*
    // ## Para guardar imagen
    if($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $permitidos = array("image/jpg", "image/jpeg");
        if (in_array($_FILES['imagen']['type'], $permitidos)) {
            $dir = "imagenes";
            $infoImagen = pathinfo($_FILES["imagen"]["name"]);
            $infoImagen['extension'];
            $imagen = $dir . '/' . $id . '.jpg';
            
            if (!file_exists($dir)) {
                mkdir($dir,0777);
            }
            if(!move_uploaded_file($_FILES['imagen']['tmpName'], $imagen)){
                $_SESSION['color'] = "danger";
                $_SESSION['mensaje'] .= "<br>Error al guardar la imagen";
            } 
        } else {
            $_SESSION['color'] = "danger";
            $_SESSION['mensaje'] .= "<br>Formato de imagen no permitido";
        }
    }

} else {
    $_SESSION['color'] = "danger";
    $_SESSION['mensaje'] = "Error al guardar la imagen";
*/

}

header('Location: clientes.php');

?>