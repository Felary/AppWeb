<?php
// Inicia una nueva sesión o reanuda la existente
session_start();

// Si no hay una sesión de usuario iniciada, redirige al usuario a la página de inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

// Establece un mensaje de sesión para la eliminación de la cuenta de usuario
$_SESSION["mensaje"] = "Eliminación de cuenta de usuario";

// Si se pasan los parámetros de usuario, correo y contraseña a través de GET, se establecen en la sesión
if (isset($_GET["usuario"]) && isset($_GET["correo"]) && isset($_GET["contraseña"])) {
    $_SESSION['usuario'] = $_GET['usuario'];
    $_SESSION['correo'] = $_GET['correo'];
    $_SESSION['contraseña'] = $_GET['contraseña'];
}

// Incluye el archivo de conexión a la base de datos
include("./conexion.php");

// Si el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene la contraseña de la sesión
    $password = $_SESSION["contraseña"];
    // Obtiene la confirmación de la contraseña del formulario
    $confirmar = $_POST["confirmar"];

    // Si la contraseña y la confirmación coinciden
    if ($password == $confirmar) {
        // Obtiene el usuario de la sesión
        $user = $_SESSION['usuario'];
        // Prepara una sentencia SQL para eliminar el registro del usuario
        $sentencia = $conexion->prepare("DELETE FROM registro WHERE usuario = ? AND contraseña = ?");
        // Ejecuta la sentencia SQL con los parámetros de usuario y contraseña
        $sentencia->execute([$user, $password]);
        // Destruye la sesión
        session_destroy();
        // Redirige al usuario a la página de inicio
        header("Location: index.php");
    } else {
        // Si las contraseñas no coinciden, establece un mensaje de sesión
        $_SESSION["mensaje"] = "Las contraseñas no coinciden";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos del documento -->
    <!-- Define la codificación de caracteres para el documento -->
    <meta charset="UTF-8" />
    <!-- Configura la vista del viewport para dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Enlaces a recursos externos -->
    <!-- Define el icono de la página web (favicon) -->
    <link href="imagenes/icono_hamburguesa.ico" rel="shor cut icon" />
    <!-- Enlaza la hoja de estilos CSS para la página -->
    <link href="css/style_registro.css" rel="stylesheet" />

    <!-- Título de la página -->
    <!-- Define el título de la página web, que se muestra en la pestaña del navegador -->
    <title>Azabache Fast Food</title>
</head>

<body>
    <!-- Inicio de la cabecera -->
    <header class="header">
        <?php
        // Incluye el contenido del archivo 'menuSecundario.html' una sola vez
        include_once 'menuSecundario.html'
        ?>
    </header>
    <!-- Fin de la cabecera -->
    <!-- Inicio de la barra de navegación para la sección de acceso -->
    <nav class="accesos">

        <!-- Otras opciones de acceso -->
        <!-- Contenedor para la opción de "Modificar" -->
        <div class="casilla_inactiva">
            <!-- Enlace a la página de modificación de perfil -->
            <a class="acceso_items" href="modificarPerfil.php">Modificar</a>
        </div>

        <!-- Otras opciones de acceso -->
        <!-- Contenedor para la opción de "Eliminar" -->
        <div class="casilla_activa">
            <!-- Enlace a la página de eliminación de perfil -->
            <a class="acceso_items" href="eliminarPerfil.php">Eliminar</a>
        </div>

    </nav>
    <!-- Fin de la barra de navegación -->
    <!-- Inicio de la sección de la barra -->
    <section class="barra">

        <!-- Inicio del contenedor principal -->
        <main class="carrito">
            <!-- Título de la sección -->
            <h2 class="carrito_titulo">Eliminación Perfil</h2>
            <hr>
            <!-- Inicio del contenedor de inicio de sesión -->
            <div class="login-container">
                <!-- Inicio del formulario de eliminación de perfil -->
                <form action="eliminarPerfil.php" method="post">

                    <!-- Grupo de entrada para el correo -->
                    <div class="input-group">
                        <label for="email">Correo</label>
                        <!-- El valor se obtiene de la sesión y está deshabilitado -->
                        <input type="email" id="email" name="email" placeholder="correo" disabled value="<?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?>">
                    </div>

                    <!-- Grupo de entrada para el nombre de usuario -->
                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <!-- El valor se obtiene de la sesión y está deshabilitado -->
                        <input type="text" id="username" name="username" placeholder="usuario" required disabled value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>">
                    </div>

                    <!-- Grupo de entrada para la contraseña -->
                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <!-- El valor se obtiene de la sesión y está deshabilitado -->
                        <input type="password" id="password" name="password" placeholder="contraseña" required disabled value="<?php echo isset($_SESSION['contraseña']) ? $_SESSION['contraseña'] : ''; ?>">
                    </div>

                    <!-- Grupo de entrada para confirmar la contraseña -->
                    <div class="input-group">
                        <label for="password">Confirmar </label>
                        <input type="password" id="confirmar" name="confirmar" placeholder="contraseña" required>
                    </div>

                    <!-- Botón de envío del formulario -->
                    <button type="submit" id="eliminar">Eliminar</button>
                </form>
                <!-- Fin del formulario de eliminación de perfil -->
            </div>
            <!-- Fin del contenedor de inicio de sesión -->
        </main>
        <!-- Fin del contenedor principal -->

        <!-- Inicio del contenedor secundario -->
        <main class="carrito_pedido">
            <section class="container_lateral">
                <!-- Muestra el mensaje de la sesión -->
                <div style="margin-top: 15px;">
                    <?php
                    echo $_SESSION["mensaje"];
                    ?>
                </div>
                <!-- Imagen lateral -->
                <img class="container_lateral_imagen" src="imagenes/hamburguesa1.jpg" alt="..." />
                <!-- Mensaje de bienvenida -->
                <h2>Bienvenido a Azabache Fast Food</h2>
                <!-- Columna para el resumen del pedido -->

            </section>
        </main>
        <!-- Fin del contenedor secundario -->
    </section>
    <!-- Fin de la sección de la barra -->

    <hr>
    <!-- Inicio del pie de página -->
    <footer>
        <?php
        // Incluye el contenido del archivo 'piePagina.html' una sola vez
        include_once 'piePagina.html'
        ?>
    </footer>
    <!-- Fin del pie de página -->
</body>


</html>