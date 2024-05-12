<?php
try {
    // $conexionbd = new PDO("mysql:host=localhost; dbname=partes2024;charset=utf8", "root", "");

    $host = getenv('MYSQLHOST');
    $dbname = getenv('MYSQLDATABASE');
    $user = getenv('MYSQLUSER');
    $password = getenv('MYSQLPASSWORD');
    
    $conexionbd = new PDO("mysql:host=$host; dbname=$dbname;charset=utf8", $user, $password);
} catch (Exception $e) {
    die("Error de CONEXIÓN de la base de datos") . $e->getMessage();
}
