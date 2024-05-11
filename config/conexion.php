<?php
try {
    $conexionbd = new PDO ("mysql:host=localhost; dbname=partes2024;charset=utf8","root","");
} catch (Exception $e) {
    die("Error de CONEXIÓN de la base de datos"). $e->getMessage();
}
