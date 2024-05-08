<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
$_SESSION["mensaje"] = "Eliminación de cuenta de usuario";

include("./conexion.php");

if (isset($_POST["user"])) {
    $user = $_POST["user"];

    $sentencia = $conexion->prepare("SELECT * FROM registro WHERE correo = ? OR usuario = ?");
    $sentencia->execute([$user, $user]);
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($usuario) { 
        $email = $usuario['correo'];
        $username = $usuario['usuario'];
        $password = $usuario['contraseña'];
        $_SESSION["mensaje"] = "Usuario encontrado";
    }
    else{
        $_SESSION["mensaje"] = "Usuario no encontrado";
        
    }
}
if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmar"])) {
    $user = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    // Verifica si las contraseñas son iguales
    if ($password == $confirmar) {

        $sentencia = $conexion->prepare("SELECT * FROM registro WHERE correo = ?");
        $sentencia->execute([$email]);
        if ($sentencia->rowCount() > 0) {
            // Prepara una consulta SQL para actualizar los datos en la base de datos
            $sentencia = $conexion->prepare("UPDATE registro SET usuario = ?, contraseña = ? WHERE correo = ?");
            $resultado = $sentencia->execute([$user, $password, $email]);
            if ($resultado) {
                $_SESSION["nombre"] = $user;
                $_SESSION["mensaje"] = "Datos actualizados";
            }
        } else {
            $_SESSION["mensaje"] = "El correo no coincide con ningun usuario";
        }
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
    <link href="css/style_gestion.css" rel="stylesheet" />

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

        <main class="carrito1">
            <h2 class="carrito_titulo">Buscar Perfil</h2>
            <hr>
            <div class="login-container">
                <!-- Inicio del formulario de inicio de sesión -->
                <form action="eliminarPerfil.php" method="post">

                    <div class="input-group">
                        <label for="text">Buscar</label>
                        <input type="text" id="usuer" name="user" placeholder="correo ó usuario" required autofocus>
                    </div>

                    <!-- Botón de envío del formulario -->
                    <button type="submit" id="buscar">Buscar</button>
                </form>
                <!-- Fin del formulario de inicio de sesión -->
            </div>
        </main>



        <main class="carrito">
            <h2 class="carrito_titulo">Eliminación Perfil</h2>
            <hr>
            <div class="login-container">
                <!-- Inicio del formulario de inicio de sesión -->
                <form action="eliminarPerfil.php" method="post">

                    <div class="input-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" placeholder="correo" required autofocus>
                    </div>
                    <!-- Grupo de entrada para el nombre de usuario -->
                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" placeholder="usuario" required>
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
                    <button type="submit" id="eliminar">Eliminar</button>
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