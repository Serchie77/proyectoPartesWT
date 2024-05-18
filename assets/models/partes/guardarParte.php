<!-- INSERTA PROYECTOS NUEVOS -->
<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idParte = filter_input(INPUT_POST, 'idParte', FILTER_SANITIZE_NUMBER_INT);
$fechaInicio = filter_input(INPUT_POST, 'fechaInicio', FILTER_SANITIZE_STRING);
$fechaFin = filter_input(INPUT_POST, 'fechaFin', FILTER_SANITIZE_STRING);
$totalHorasNormales = filter_input(INPUT_POST, 'totalHorasNormales', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$totalHorasExtras = filter_input(INPUT_POST, 'totalHorasExtras', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$horasViaje = filter_input(INPUT_POST, 'horasViaje', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$comentarios = filter_input(INPUT_POST, 'comentarios', FILTER_SANITIZE_STRING);
$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_NUMBER_INT);
$idProyecto = filter_input(INPUT_POST, 'idProyecto', FILTER_SANITIZE_NUMBER_INT);

try {
    // Preparación de la consulta
    $insertarPartes = $conexionbd->prepare("INSERT INTO partes (idParte, fechaInicio, fechaFin, totalHorasNormales, totalHorasExtras, horasViaje, comentarios, idUsuario, idProyecto)
        VALUES (:idParte, :fechaInicio, :fechaFin, :totalHorasNormales, :totalHorasExtras, :horasViaje, :comentarios, :idUsuario, :idProyecto)
    ");
    // Enlaces de parámetros
    $insertarPartes->bindParam(':idParte', $idParte);
    $insertarPartes->bindParam(':fechaInicio', $fechaInicio);
    $insertarPartes->bindParam(':fechaFin', $fechaFin);
    $insertarPartes->bindParam(':totalHorasNormales', $totalHorasNormales);
    $insertarPartes->bindParam(':totalHorasExtras', $totalHorasExtras);
    $insertarPartes->bindParam(':horasViaje', $horasViaje);
    $insertarPartes->bindParam(':comentarios', $comentarios);
    $insertarPartes->bindParam(':idUsuario', $idUsuario);
    $insertarPartes->bindParam(':idProyecto', $idProyecto);

    // Ejecución de la consulta
    $resultado = $insertarPartes->execute();

    // Manejo del resultado
    if ($resultado) {
        $id = $conexionbd->lastInsertId();
        // Mensaje de guardado correctamente
        $_SESSION['color'] = "success";
        $_SESSION['mensaje'] = "Registro guardado";

        /*
        // Para guardar imagen
        if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $permitidos = array("image/jpg", "image/jpeg");
            if (in_array($_FILES['imagen']['type'], $permitidos)) {
                $dir = "imagenes";
                $infoImagen = pathinfo($_FILES["imagen"]["name"]);
                $infoImagen['extension'];
                $imagen = $dir . '/' . $id . '.jpg';

                if (!file_exists($dir)) {
                    mkdir($dir, 0777);
                }
                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen)) {
                    $_SESSION['color'] = "danger";
                    $_SESSION['mensaje'] .= "<br>Error al guardar la imagen";
                }
            } else {
                $_SESSION['color'] = "danger";
                $_SESSION['mensaje'] .= "<br>Formato de imagen no permitido";
            }
        }
        */

    } else {
        $_SESSION['color'] = "danger";
        $_SESSION['mensaje'] = "Error al guardar el registro";
    }
} catch (Exception $e) {
    $_SESSION['color'] = "danger";
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

header('Location: partes.php');
?>
