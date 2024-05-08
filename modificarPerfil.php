<?php
// Inicia la sesión
session_start();

// Si el usuario no está logueado, redirige a la página de login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

// Establece un mensaje inicial en la sesión
$_SESSION["mensaje"] = "Actualizacion de datos personales";

// Si se pasaron datos de usuario, correo y contraseña por GET, los guarda en la sesión
if (isset($_GET["usuario"]) && isset($_GET["correo"]) && isset($_GET["contraseña"])) {
    $_SESSION['usuario'] = $_GET['usuario'];
    $_SESSION['correo'] = $_GET['correo'];
    $_SESSION['contraseña'] = $_GET['contraseña'];
}

// Incluye el archivo de conexión a la base de datos
include("./conexion.php");

// Si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $user = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    // Verifica si las contraseñas son iguales
    if ($password == $confirmar) {
        // Prepara una consulta SQL para buscar el usuario por correo
        $sentencia = $conexion->prepare("SELECT * FROM registro WHERE correo = ?");
        $sentencia->execute([$email]);
        // Si el usuario existe
        if ($sentencia->rowCount() > 0) {
            // Prepara una consulta SQL para actualizar los datos en la base de datos
            $sentencia = $conexion->prepare("UPDATE registro SET usuario = ?, contraseña = ? WHERE correo = ?");
            $resultado = $sentencia->execute([$user, $password, $email]);
            // Si la actualización fue exitosa
            if ($resultado) {
                // Actualiza los datos en la sesión
                $_SESSION["usuario"] = $user;
                $_SESSION["correo"] = $email;
                $_SESSION["contraseña"] = $password;
                $_SESSION["mensaje"] = "Datos actualizados";
            }
        } else {
            // Si el correo no existe, establece un mensaje de error
            $_SESSION["mensaje"] = "El correo no coincide con ningun usuario";
        }
    } else {
        // Si las contraseñas no coinciden, establece un mensaje de error
        $_SESSION["mensaje"] = "Las contraseñas no coinciden";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos del documento -->
    <!-- Define la codificación de caracteres del documento -->
    <meta charset="UTF-8" />
    <!-- Hace que la página sea responsive, es decir, se adapte al tamaño de la pantalla del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Enlaces a recursos externos -->
    <!-- Define el icono de la página -->
    <link href="imagenes/icono_hamburguesa.ico" rel="shortcut icon" />
    <!-- Enlaza la hoja de estilos CSS del registro -->
    <link href="css/style_registro.css" rel="stylesheet" />

    <!-- Título de la página -->
    <title>Azabache Fast Food</title>
</head>

<body>
    <!-- Inicio del encabezado -->
    <header class="header">
        <?php
        // Incluye el archivo 'menuSecundario.html' una sola vez
        include_once 'menuSecundario.html'
        ?>
    </header>
    <!-- Fin del encabezado -->
    <!-- Barra de navegación para la sección de acceso -->
    <nav class="accesos">
        <!-- Opción de acceso para modificar el perfil -->
        <div class="casilla_activa">
            <a class="acceso_items" href="modificarPerfil.php">Modificar</a>
        </div>
        <!-- Opción de acceso para eliminar el perfil -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="eliminarPerfil.php">Eliminar</a>
        </div>
    </nav>
    <!-- Inicio de la sección -->
    <section class="barra">
        <!-- Inicio del contenedor principal -->
        <main class="carrito">
            <!-- Título de la sección -->
            <h2 class="carrito_titulo">Modificar Perfil</h2>
            <hr>
            <!-- Inicio del contenedor de inicio de sesión -->
            <div class="login-container">
                <!-- Inicio del formulario de modificación de perfil -->
                <form action="modificarPerfil.php" method="post">
                    <!-- Grupo de entrada para el correo -->
                    <div class="input-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" placeholder="correo"
                            value="<?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?>">
                    </div>
                    <!-- Grupo de entrada para el nombre de usuario -->
                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" placeholder="usuario" required autofocus
                            value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>">
                    </div>
                    <!-- Grupo de entrada para la contraseña -->
                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="contraseña" required
                            value="<?php echo isset($_SESSION['contraseña']) ? $_SESSION['contraseña'] : ''; ?>">
                    </div>
                    <!-- Grupo de entrada para confirmar la contraseña -->
                    <div class="input-group">
                        <label for="password">Confirmar </label>
                        <input type="password" id="confirmar" name="confirmar" placeholder="confirmar contraseña"
                            required>
                    </div>
                    <!-- Botón de envío del formulario -->
                    <button type="submit" id="modificar">Modificar</button>
                </form>
                <!-- Fin del formulario de modificación de perfil -->
            </div>
        </main>
        <!-- Inicio del contenedor del pedido -->
        <main class="carrito_pedido">
            <section class="container_lateral">
                <!-- Mensaje de la sesión -->
                <div style="margin-top: 15px;">
                    <?php
                    echo $_SESSION["mensaje"];
                    ?>
                </div>
                <!-- Imagen lateral -->
                <img class="container_lateral_imagen" src="imagenes/hamburguesa1.jpg" alt="..." />
                <!-- Mensaje de bienvenida -->
                <h2>Bienvenido a Azabache Fast Food</h2>
            </section>
        </main>
    </section>
    <!-- Fin de la sección -->

    <hr>
    <!-- Inicio del pie de página -->
    <footer>
        <?php
        // Incluye el archivo 'piePagina.html' una sola vez
        include_once 'piePagina.html'
        ?>
    </footer>
    <!-- Fin del pie de página -->
</body>


</html>