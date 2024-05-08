<?php

//PHP PDO data objects es un conjunto de clases que permite interactuar con diferentes bases de datos
// Definición de las variables de conexión
$servidor = "127.0.0.1";
$usuario = "root";
$clave = "";

try {
    // Intento de conexión a la base de datos
    $conexion = new PDO("mysql:host=$servidor;dbname=azabache_bd", $usuario, $clave);
    // Establecimiento del modo de error para lanzar excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $msg) {
    // En caso de error en la conexión, se muestra un mensaje
    echo "Conexion fallida " . $msg->getMessage();
}
//PDO::ATTR_ERRMODE para obtener informe de algún error al intentar conectar y
// PDO::ERRMODE_EXCEPTION para emitir excepciones al conectar a la Base de Datos.
