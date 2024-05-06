<?php
include("./conexion.php");
if (isset($_POST["username"])) {
  $user = $_POST["username"];
  $password = $_POST["password"];
  $sentencia = $conexion->prepare("SELECT * FROM registro WHERE usuario = ? AND contraseña = ?");
  $sentencia->execute([$user, $password]);
  $resultado = $sentencia->fetch();  
  if ($resultado != false) {
    $_SESSION["nombre"] = $user;
    header("Location: index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagenes/icono_hamburguesa.ico" rel="shor cut icon"> <!-- Icono del sitio -->
    <link href="css/style_login.css" rel="stylesheet"> <!-- Enlace a la hoja de estilos CSS -->
    <title>Azabache Fast Food</title> <!-- Título de la página -->
</head>

<body>


    <!-- Encabezado -->
    <header class="header">
        <!-- Logo del sitio -->
        <a href="login.php"><img class="header_logo" src="imagenes/azabache_Logo.png" alt /></a>


        <!-- Menú de navegación -->
        <div class="header_menu">
            <a class="header_items" href="login.php">
                <img class="header_imagen" src="imagenes/menu.png" alt></a>
        </div>
    </header>

    <!-- Barra de navegación para la sección de acceso -->
    <nav class="accesos">

        <!-- Otras opciones de acceso -->
        <div class="casilla_activa">
            <a class="acceso_items" href="login.php">Loguearse</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="registro.php">Registrarse</a>
        </div>

    </nav>

    <section class="barra">

        <main class="carrito">

            <h2 class="carrito_titulo">Iniciar Sesión</h2>
            <hr>


            <div class="login-container">
                <!-- Inicio del formulario de inicio de sesión -->
                <form action="Login.php" method="post">
                    <!-- Grupo de entrada para el nombre de usuario -->
                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" required autofocus>
                    </div>
                    <!-- Grupo de entrada para la contraseña -->
                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <!-- Botón de envío del formulario -->
                    <button type="submit" id="ingresar">Ingresar</button>
                </form>
                <!-- Fin del formulario de inicio de sesión -->
            </div>
        </main>


        <main class="carrito_pedido">
            <section class="container_lateral">
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