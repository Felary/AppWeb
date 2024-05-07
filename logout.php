<?php
session_start(); // Inicia la sesión
session_destroy(); // Destruye la sesión
header("Location: login.php"); // Redirecciona al usuario a la página de login
?>