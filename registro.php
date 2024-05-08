<?php
session_start(); 

$_SESSION["mensaje"] = "Se continuara con el proceso una vez te registres";

include("./conexion.php");
if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmar"])) {
    $user = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    // Verifica si todos los campos están llenos
    if ($user != '' && $email != '' && $password != '' && $confirmar != '') {
        // Verifica si las contraseñas son iguales
        if ($password == $confirmar) {
            $sentencia = $conexion->prepare("insert into registro (usuario, correo, contraseña)values(?,?,?);");
            $resultado = $sentencia->execute([$user, $email, $password]);

            if ($resultado == true) {
                header("Location: index.php");
            }
        } else {
            $_SESSION["mensaje"] = "Las contraseñas no coinciden";
        }
    } else {
        $_SESSION["mensaje"] = "Por favor, completa todos los campos";
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
    <!-- Encabezado -->
    <header class="header">
        <!-- Logo del sitio -->
        <a href="registro.php"><img class="header_logo" src="imagenes/azabache_Logo.png" alt /></a>
        <!-- Menú de navegación -->
        <div class="header_menu">
            <a class="header_items" href="registro.php">
                <img class="header_imagen" src="imagenes/menu.png" alt></a>
        </div>
    </header>
    <!-- Barra de navegación para la sección de acceso -->
    <nav class="accesos">

        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="login.php">Loguearse</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_activa">
            <a class="acceso_items" href="registro.php">Registrarse</a>
        </div>

    </nav>
    <section class="barra">

        <main class="carrito">

            <h2 class="carrito_titulo">Registro</h2>
            <hr>


            <div class="login-container">
                <!-- Inicio del formulario de inicio de sesión -->
                <form action="registro.php" method="post">
                    <!-- Grupo de entrada para el nombre de usuario -->
                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" placeholder="usuario" required autofocus>
                    </div>
                    <!-- Grupo de entrada para la contraseña -->
                    <div class="input-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" placeholder="correo" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="contraseña" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Confirmar </label>
                        <input type="password" id="confirmar" name="confirmar" placeholder="contraseña" required>
                    </div>
                    <!-- Botón de envío del formulario -->
                    <button type="submit" id="registrar">Registrarse</button>
                </form>
                <!-- Fin del formulario de inicio de sesión -->
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