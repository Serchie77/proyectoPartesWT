<!-- INSERTA PROYECTOS NUEVOS -->
<?php
// Inicio de sesión
session_start();

// Conexión a la base de datos
require '../../config/conexion.php';

// Configura PDO para lanzar excepciones cuando ocurra un error
$conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Recogida de datos del formulario y saneamiento
$idParteHora = filter_input(INPUT_POST, 'idParteHora', FILTER_SANITIZE_NUMBER_INT);
$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
$horasNormales = filter_input(INPUT_POST, 'horasNormales', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$horasExtras = filter_input(INPUT_POST, 'horasExtras', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$idParte = filter_input(INPUT_POST, 'idParte', FILTER_SANITIZE_NUMBER_INT);
$idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_NUMBER_INT);

try {
    // Preparación de la consulta
    $insertarHoras = $conexionbd->prepare("
        INSERT INTO partesHoras (idParteHora, fecha, horasNormales, horasExtras, idParte, idUsuario)
        VALUES (:idParteHora, :fecha, :horasNormales, :horasExtras, :idParte, :idUsuario)
    ");
    // Enlaces de parámetros
    $insertarHoras->bindParam(':idParteHora', $idParteHora);
    $insertarHoras->bindParam(':fecha', $fecha);
    $insertarHoras->bindParam(':horasNormales', $horasNormales);
    $insertarHoras->bindParam(':horasExtras', $horasExtras);
    $insertarHoras->bindParam(':idParte', $idParte);
    $insertarHoras->bindParam(':idUsuario', $idUsuario);

    // Ejecución de la consulta
    $resultado = $insertarHoras->execute();

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

header('Location: horas.php');
?>
