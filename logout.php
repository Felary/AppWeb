<?php
// Inicia la sesión
session_start();

// Destruye todas las variables de sesión
session_destroy();

// Redirecciona al usuario a la página de login
header("Location: login.php");
?>