<?php

// $host = getenv('MYSQLHOST');
// $dbname = getenv('MYSQLDATABASE');
// $user = getenv('MYSQLUSER');
// $password = getenv('MYSQLPASSWORD');
// $port = getenv('MYSQLPORT');

// $conexionbd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $password);

try {
    $conexionbd = new PDO("mysql:host=localhost; dbname=partes2024;charset=utf8", "root", "");

} catch (Exception $e) {
    die("Error de CONEXIÓN de la base de datos") . $e->getMessage();
}
