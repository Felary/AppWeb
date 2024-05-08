<?php
// Inicia la sesión PHP
session_start(); 

// Mensaje de error por defecto
$_SESSION["mensaje"] = "Inicia sesión para continuar ";

// Incluye el archivo de conexión a la base de datos
include("./conexion.php");

// Verifica si se ha enviado el formulario de inicio de sesión
if (isset($_POST["username"])) {

    // Obtiene las credenciales del formulario
    $user = $_POST["username"]; // Nombre de usuario ingresado
    $password = $_POST["password"]; // Contraseña ingresada

    // Prepara una consulta SQL para validar las credenciales
    $sentencia = $conexion->prepare("SELECT * FROM registro WHERE usuario = ? AND contraseña = ?");
    $sentencia->execute([$user, $password]); // Ejecuta la consulta con los valores del usuario y la contraseña

    // Almacena el resultado de la consulta
    $resultado = $sentencia->fetch(); // Obtiene la primera fila del conjunto de resultados

    // Si la consulta devuelve un resultado (usuario encontrado)
    if ($resultado != false) {

        // Almacena la información del usuario en variables de sesión
        $_SESSION["usuario"] = $user; // Guarda el nombre de usuario en la sesión
        $_SESSION["correo"] = $resultado["correo"]; // Guarda el correo electrónico del usuario en la sesión
        $_SESSION["contraseña"] = $resultado["contraseña"]; // Guarda la contraseña del usuario en la sesión

        // Redirecciona a la página principal (index.php)
        header("Location: index.php"); // Envía una cabecera HTTP para redirigir al usuario
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Define la codificación de caracteres para el documento -->
    <meta charset="UTF-8">
    <!-- Hace que la página sea responsive, es decir, se adapte al tamaño de la pantalla del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el icono de la página que se muestra en la pestaña del navegador -->
    <link href="imagenes/icono_hamburguesa.ico" rel="shortcut icon">
    <!-- Enlaza la hoja de estilos CSS que se utilizará para el estilo de la página -->
    <link href="css/style_login.css" rel="stylesheet">
    <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <title>Azabache Fast Food</title>
</head>

<body>

    <!-- Inicio del encabezado de la página -->
    <header class="header">
        <!-- Enlace que lleva a login.php cuando se hace clic en la imagen del logo -->
        <a href="login.php">
            <!-- Imagen del logo de la empresa -->
            <img class="header_logo" src="imagenes/azabache_Logo.png" alt />
        </a>

        <!-- Contenedor del menú del encabezado -->
        <div class="header_menu">
            <!-- Elemento del menú que lleva a login.php cuando se hace clic en la imagen del menú -->
            <a class="header_items" href="login.php">
                <!-- Imagen del menú -->
                <img class="header_imagen" src="imagenes/menu.png" alt>
            </a>
        </div>
        <!-- Fin del encabezado de la página -->
    </header>



    <!-- Inicio de la barra de navegación -->
    <nav class="accesos">
        <!-- Contenedor del primer enlace, que está activo -->
        <div class="casilla_activa">
            <!-- Enlace a la página de inicio de sesión -->
            <a class="acceso_items" href="login.php">Loguearse</a>
        </div>
        <!-- Contenedor del segundo enlace, que está inactivo -->
        <div class="casilla_inactiva">
            <!-- Enlace a la página de registro -->
            <a class="acceso_items" href="registro.php">Registrarse</a>
        </div>
        <!-- Fin de la barra de navegación -->
    </nav>

    <!-- Inicio de la sección -->
    <section class="barra">
        <!-- Inicio del formulario de inicio de sesión -->
        <main class="carrito">
            <h2 class="carrito_titulo">Iniciar Sesión</h2>
            <hr>
            <div class="login-container">
                <!-- Formulario de inicio de sesión que envía los datos a Login.php -->
                <form action="Login.php" method="post">
                    <!-- Campo de entrada para el nombre de usuario -->
                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" required autofocus>
                    </div>
                    <!-- Campo de entrada para la contraseña -->
                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <!-- Botón de envío del formulario -->
                    <button type="submit" id="ingresar">Ingresar</button>
                </form>
            </div>
        </main>
        <!-- Fin del formulario de inicio de sesión -->

        <!-- Inicio de la sección lateral -->
        <main class="carrito_pedido">
            <section class="container_lateral">
                <!-- Muestra un mensaje de la sesión -->
                <div style="margin-top: 15px;">
                    <?php
                    echo $_SESSION["mensaje"];
                    ?>
                </div>
                <!-- Imagen de la sección lateral -->
                <img class="container_lateral_imagen" src="imagenes/hamburguesa1.jpg" alt="..." />
                <!-- Título de bienvenida de la sección lateral -->
                <h2>Bienvenido a Azabache Fast Food</h2>
            </section>
        </main>
        <!-- Fin de la sección lateral -->
        <!-- Fin de la sección -->
    </section>
    <hr>

    <!-- Inicio del pie de página -->
    <footer>
        <?php
        // Incluye el contenido del archivo piePagina.html
        include_once 'piePagina.html'
        ?>
        <!-- Fin del pie de página -->
    </footer>
</body>

</html>