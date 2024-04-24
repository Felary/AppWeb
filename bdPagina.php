<?php
// PHP PDO data obajects es un conjunto de clases que permite interactuar con diferentes bases de datos
$servidor = "127.0.0.1";
$usuario = "root";
$contraseña = "";


//Se Crea el try catch para manejar las excepciones
try {
    //Se crea la conexion a la base de datos con PDO y se le pasa el servidor, la base de datos, el usuario y la contraseña 
    $conexion = new PDO("mysql:host=$servidor;dbname=hamburgueseria", $usuario, $contraseña);
    //Se establece el modo de error a excepcion para que muestre los errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Se muestra un mensaje de conexion exitosa
    echo "<br> Conexion exitosa <br>";
} catch (PDOException $msg) {
    //En caso de error se muestra un mensaje con el error
    echo "Conexion fallida: " . $msg->getMessage();
}


//Se crea una sentencia para seleccionar todos los registros de la tabla usuario
$sentencia = $conexion->prepare("SELECT * FROM usuario");
//Se ejecuta la sentencia
$sentencia->execute();
//Se recorre el resultado de la sentencia   
while ($consulta = $sentencia->fetch()) {
    //Se muestran los datos en la tabla
    echo "<tr>";
    echo "<td> " . $consulta['id'] . "</td>";
    echo "<td> " . $consulta['nombre'] . "</td>";
    echo "<td> " . $consulta['apellido'] . "</td>";
    echo "<td> " . $consulta['activo'] . "</td>";
    echo "</tr>";
}
