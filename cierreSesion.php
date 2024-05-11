<?php

// Inicia la sesión
require_once 'sesion.php';

// Cierra la sesión
session_unset();
session_destroy();

// Redirige al usuario a la página de inicio
header('Location: index.php');
exit();
?>
