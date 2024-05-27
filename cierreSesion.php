<?php

// Inicia la sesión
require_once 'sesion.php';

// Cierra la sesión
session_unset();
session_destroy();
setcookie(session_name(), '', 0, '/');

// Redirige al usuario a la página de inicio
header('Location: index.php');
exit();
