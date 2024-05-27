<?php
require_once 'config/conexion.php';

// Obtener el ID del usuario logueado
$idUsuario = $_SESSION['idUsuario'];

// ## CONSULTAS PARA EL ADMINISTRADOR
function contarClientes($conexionbd) {
    $consulta = $conexionbd->prepare("SELECT COUNT(*) as total FROM clientes");
    $consulta->execute();
    $resultado = $consulta->fetch();
    return $resultado['total'];
}

function contarProyectos($conexionbd) {
    $consulta = $conexionbd->prepare("SELECT COUNT(*) as total FROM proyectos");
    $consulta->execute();
    $resultado = $consulta->fetch();
    return $resultado['total'];
}
function contarUsuarios($conexionbd) {
    $consulta = $conexionbd->prepare("SELECT COUNT(*) as total FROM usuarios WHERE idRol > 1");
    $consulta->execute();
    $resultado = $consulta->fetch();
    return $resultado['total'];
}
function contarPartes($conexionbd) {
    $consulta = $conexionbd->prepare("SELECT COUNT(*) as total FROM partes");
    $consulta->execute();
    $resultado = $consulta->fetch();
    return $resultado['total'];
}

function contarHoras($conexionbd) {
    $consulta = $conexionbd->prepare("SELECT SUM(horasNormales) as total FROM partesHoras");
    $consulta->execute();
    $resultado = $consulta->fetch();
    return $resultado['total'];
}


function contarHorasUsuario($conexionbd, $idUsuario) {
    $consulta = $conexionbd->prepare("SELECT SUM(HorasNormales) as total FROM partesHoras WHERE idUsuario = :idUsuario");
    $consulta->bindParam(':idUsuario', $idUsuario);
    $consulta->execute();
    $resultado = $consulta->fetch();
    return $resultado['total'];
}

function contarPartesUsuarios($conexionbd, $idUsuario) {
    $consulta = $conexionbd->prepare("SELECT COUNT(*) as total FROM partes WHERE idUsuario = :idUsuario");
    $consulta->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    return $resultado['total'];
}



function obtenerProyectosConTrabajadores($conexionbd) {
    try {
        $consulta = $conexionbd->prepare(
            "SELECT 
                p.nombre AS nombreProyecto,
                p.fechaInicio AS fechaInicio,
                p.fechaFin AS fechaFin,
                SUM(ph.horasNormales) AS totalHorasNormales,
                SUM(ph.horasExtras) AS totalHorasExtras,
                GROUP_CONCAT(CONCAT(u.nombre, ' ', u.apellidos) SEPARATOR ', ') AS trabajadores
            FROM 
                proyectos p
            INNER JOIN 
                clientes c ON p.idCliente = c.idCliente
            LEFT JOIN 
                partes pt ON p.idProyecto = pt.idProyecto
            LEFT JOIN 
                usuarios u ON pt.idUsuario = u.idUsuario
            LEFT JOIN 
                partesHoras ph ON pt.idParte = ph.idParte
            GROUP BY 
                p.idProyecto
            ORDER BY 
                p.fechaInicio ASC"
        );

        $consulta->execute();
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    } catch (PDOException $e) {
        echo "Error al obtener proyectos con trabajadores: " . $e->getMessage();
        return false;
    }
}







