<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
$_SESSION["mensaje"] = "Eliminación de cuenta de usuario";

if (isset($_GET["usuario"]) && isset($_GET["correo"]) && isset($_GET["contraseña"])) {
    $_SESSION['usuario'] = $_GET['usuario'];
    $_SESSION['correo'] = $_GET['correo'];
    $_SESSION['contraseña'] = $_GET['contraseña'];
}
include("./conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_SESSION["contraseña"];
    $confirmar = $_POST["confirmar"];
    if ($password == $confirmar) {

        $user = $_SESSION['usuario'];
        $sentencia = $conexion->prepare("DELETE FROM registro WHERE usuario = ? AND contraseña = ?");
        $sentencia->execute([$user, $password]);
        session_destroy();
        header("Location: index.php");
    } else {
        $_SESSION["mensaje"] = "Las contraseñas no coinciden";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos del documento -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Enlaces a recursos externos -->
    <link href="imagenes/icono_hamburguesa.ico" rel="shor cut icon" />
    <link href="css/style_registro.css" rel="stylesheet" />

    <!-- Título de la página -->
    <title>Azabache Fast Food</title>
</head>

<body>
    <header class="header">

        <?php
        include_once 'menuSecundario.html'
        ?>

    </header>
    <!-- Barra de navegación para la sección de acceso -->
    <nav class="accesos">

        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="modificarPerfil.php">Modificar</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_activa">
            <a class="acceso_items" href="eliminarPerfil.php">Eliminar</a>
        </div>

    </nav>
    <section class="barra">

        <main class="carrito">
            <h2 class="carrito_titulo">Eliminación Perfil</h2>
            <hr>
            <div class="login-container">
                <!-- Inicio del formulario de inicio de sesión -->
                <form action="eliminarPerfil.php" method="post">

                    <div class="input-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" placeholder="correo" disabled
                            value="<?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?>">
                    </div>

                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" placeholder="usuario" required disabled
                            value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>">
                    </div>

                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="contraseña" required disabled
                            value="<?php echo isset($_SESSION['contraseña']) ? $_SESSION['contraseña'] : ''; ?>">
                    </div>
                    <div class="input-group">
                        <label for="password">Confirmar </label>
                        <input type="password" id="confirmar" name="confirmar" placeholder="contraseña" required>
                    </div>
                    <!-- Botón de envío del formulario -->
                    <button type="submit" id="eliminar">Eliminar</button>
                </form>
            </div>
        </main>



        <main class="carrito_pedido">
            <section class="container_lateral">
                <div style="margin-top: 15px;">
                    <?php
                    echo $_SESSION["mensaje"];
                    ?>
                </div>
                <!-- Imagen lateral -->
                <img class="container_lateral_imagen" src="imagenes/hamburguesa1.jpg" alt="..." />
                <!-- Botón para comprar -->
                <h2>Bienvenido a Azabache Fast Food</h2>
                <!-- Columna para el resumen del pedido -->

            </section>
        </main>
    </section>

    <hr>
    <!-- Pie de página -->
    <footer>
        <?php
        include_once 'piePagina.html'
        ?>
    </footer>
</body>


</html>