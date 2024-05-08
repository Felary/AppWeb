<?php
// Inicia una nueva sesión o reanuda la existente
session_start();

// Establece un mensaje en la sesión
$_SESSION["mensaje"] = "Se continuara con el proceso una vez te registres";

// Incluye el archivo de conexión a la base de datos
include("./conexion.php");

// Verifica si se enviaron los datos del formulario de registro
if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmar"])) {
    // Recoge los datos del formulario
    $user = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    // Verifica si todos los campos del formulario están llenos
    if ($user != '' && $email != '' && $password != '' && $confirmar != '') {
        // Verifica si las contraseñas ingresadas coinciden
        if ($password == $confirmar) {
            // Prepara la sentencia SQL para insertar los datos del usuario en la base de datos
            $sentencia = $conexion->prepare("insert into registro (usuario, correo, contraseña)values(?,?,?);");
            // Ejecuta la sentencia SQL
            $resultado = $sentencia->execute([$user, $email, $password]);

            // Verifica si la sentencia SQL se ejecutó correctamente
            if ($resultado == true) {
                // Redirige al usuario a la página de inicio
                header("Location: index.php");
            }
        } else {
            // Establece un mensaje en la sesión indicando que las contraseñas no coinciden
            $_SESSION["mensaje"] = "Las contraseñas no coinciden";
        }
    } else {
        // Establece un mensaje en la sesión indicando que todos los campos deben estar llenos
        $_SESSION["mensaje"] = "Por favor, completa todos los campos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<!-- Inicio de la sección head -->

<head>
    <!-- Define la codificación de caracteres para la página web -->
    <meta charset="UTF-8" />
    <!-- Hace que la página web sea responsive, es decir, se adapte al tamaño de la pantalla del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Define el icono de la página web -->
    <link href="imagenes/icono_hamburguesa.ico" rel="shor cut icon" />
    <!-- Enlaza la hoja de estilos CSS para la página de registro -->
    <link href="css/style_registro.css" rel="stylesheet" />

    <!-- Define el título de la página web -->
    <title>Azabache Fast Food</title>
    <!-- Fin de la sección head -->
</head>

<body>

    <!-- Inicio de la sección header -->
    <header class="header">
        <!-- Enlace al archivo registro.php con una imagen como contenido del enlace -->
        <a href="registro.php"><img class="header_logo" src="imagenes/azabache_Logo.png" alt /></a>

        <!-- Div que contiene el menú del header -->
        <div class="header_menu">
            <!-- Enlace al archivo registro.php con una imagen como contenido del enlace -->
            <a class="header_items" href="registro.php">
                <img class="header_imagen" src="imagenes/menu.png" alt></a>
        </div>
        <!-- Fin de la sección header -->
    </header>

    <!-- Inicio de la barra de navegación -->
    <nav class="accesos">
        <!-- Div que contiene un enlace a la página de inicio de sesión -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="login.php">Loguearse</a>
        </div>

        <!-- Div que contiene un enlace a la página de registro -->
        <div class="casilla_activa">
            <a class="acceso_items" href="registro.php">Registrarse</a>
        </div>
        <!-- Fin de la barra de navegación -->
    </nav>
    <!-- Inicio de la sección -->
    <section class="barra">
        <!-- Inicio del contenedor principal -->
        <main class="carrito">
            <!-- Título de la sección -->
            <h2 class="carrito_titulo">Registro</h2>
            <hr>

            <!-- Inicio del contenedor del formulario de registro -->
            <div class="login-container">
                <!-- Formulario de registro -->
                <form action="registro.php" method="post">
                    <!-- Campo de entrada para el nombre de usuario -->
                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" placeholder="usuario" required autofocus>
                    </div>
                    <!-- Campo de entrada para el correo electrónico -->
                    <div class="input-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" placeholder="correo" required>
                    </div>
                    <!-- Campo de entrada para la contraseña -->
                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="contraseña" required>
                    </div>
                    <!-- Campo de entrada para confirmar la contraseña -->
                    <div class="input-group">
                        <label for="password">Confirmar </label>
                        <input type="password" id="confirmar" name="confirmar" placeholder="contraseña" required>
                    </div>
                    <!-- Botón para enviar el formulario -->
                    <button type="submit" id="registrar">Registrarse</button>
                </form>
            </div>
        </main>

        <!-- Inicio del contenedor secundario -->
        <main class="carrito_pedido">
            <section class="container_lateral">
                <!-- Muestra un mensaje almacenado en la sesión -->
                <div style="margin-top: 15px;">
                    <?php
                    echo $_SESSION["mensaje"];
                    ?>
                </div>
                <!-- Imagen -->
                <img class="container_lateral_imagen" src="imagenes/hamburguesa1.jpg" alt="..." />
                <!-- Mensaje de bienvenida -->
                <h2>Bienvenido a Azabache Fast Food</h2>
            </section>
        </main>
        <!-- Fin de la sección -->
    </section>
    <hr>
    <!-- Inicio del pie de página -->
    <footer>
        <?php
        // Incluye el contenido del archivo 'piePagina.html'
        include_once 'piePagina.html'
        ?>
        <!-- Fin del pie de página -->
    </footer>
</body>


</html>