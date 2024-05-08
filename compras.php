<?php
// Inicia una nueva sesión o reanuda la existente
session_start();

// Verifica si el usuario está logueado, si no, redirige a la página de login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

// Incluye el archivo de conexión a la base de datos
include_once 'conexion.php';

// Inicializa la variable de sesión "cupon" con un mensaje por defecto
$_SESSION["cupon"] = "No se ha aplicado ningún cupón";

// Inicializa la variable de sesión "subtotal" con un valor por defecto
$_SESSION["subtotal"] = 12500;

// Verifica si se ha enviado un cupón
if (isset($_POST["cupon"])) {

    // Almacena el cupón enviado en una variable
    $cupon = $_POST["cupon"];

    // Prepara una sentencia SQL para buscar el cupón en la base de datos
    $sentencia = $conexion->prepare("SELECT * FROM cupones WHERE codigo = ?");

    // Ejecuta la sentencia SQL
    $sentencia->execute([$cupon]);

    // Obtiene el resultado de la sentencia SQL
    $resultado = $sentencia->fetch();

    // Verifica si el cupón es válido
    if ($resultado != false) {
        // Almacena el código y el descuento del cupón en las variables de sesión
        $_SESSION["codigo"] = $resultado["codigo"];
        $_SESSION["descuento"] = $resultado["descuento"];
        $_SESSION["cupon"] = "El cupón es válido";
    }
}

// Define el subtotal (este valor debería ser el total real de la compra)
$subtotal = 12500;

// Define el descuento (si existe un descuento en la sesión, lo usa, si no, es 0)
$descuento = isset($_SESSION["descuento"]) ? $_SESSION["descuento"] : 0;

// Calcula el nuevo total restando el descuento al subtotal
$nuevoTotal = $subtotal - $descuento;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Define la codificación de caracteres para el documento -->
    <meta charset="UTF-8">
    <!-- Hace que la página sea responsive, es decir, se adapte al tamaño de la pantalla del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el icono del sitio web que se muestra en la pestaña del navegador -->
    <link href="imagenes/icono_hamburguesa.ico" rel="shortcut icon">
    <!-- Enlaza la hoja de estilos CSS del documento -->
    <link href="css/style_compras.css" rel="stylesheet">
    <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <title>Azabache Fast Food</title>
</head>

<body>
    <!-- Inicio del encabezado de la página -->
    <header class="header">
        <?php
        // Incluye el contenido del archivo 'menuSecundario.html' una sola vez
        include_once 'menuSecundario.html'
        ?>
    </header>
    <!-- Fin del encabezado de la página -->

    <!-- Inicio de la barra de navegación para la sección de acceso -->
    <nav class="accesos">
        <!-- Casilla activa en la barra de navegación -->
        <div class="casilla_activa">
            <!-- Enlace a la página de Carrito -->
            <a class="acceso_items" href="compras.php">Carrito</a>
        </div>

        <!-- Inicio de las otras opciones de acceso -->
        <div class="casilla_inactiva">
            <!-- Enlace a la página de Perfil -->
            <a class="acceso_items" href="compras_perfil.php">Perfil</a>
        </div>
        <!-- Otra opción de acceso -->
        <div class="casilla_inactiva">
            <!-- Enlace a la página de Entrega -->
            <a class="acceso_items" href="compras.php">Entrega</a>
        </div>
        <!-- Otra opción de acceso -->
        <div class="casilla_inactiva">
            <!-- Enlace a la página de Pago -->
            <a class="acceso_items" href="compras.php">Pago</a>
        </div>
        <!-- Fin de las otras opciones de acceso -->
    </nav>
    <!-- Fin de la barra de navegación -->


    <!-- Inicio de la sección principal que contiene dos columnas: Carrito de compras y Resumen del pedido -->
    <section class="barra">
        <!-- Inicio de la columna para el carrito de compras -->
        <main class="carrito">
            <!-- Título del carrito -->
            <h2 class="carrito_titulo">Mi carrito de compras</h2>
            <hr>
            <!-- Inicio de la lista de productos en el carrito -->
            <article class="carrito_cartas">
                <!-- Producto en el carrito con checkbox, imagen y texto -->
                <input type="checkbox" class="check" checked disabled>
                <img class="carrito_imagen" src="imagenes/hamburguesa.png" alt>
                <pre class="carrito_texto">hamburguesa Clasica                                       12.500 $<img class="carrito_imagen2" src="imagenes/basura.png" alt></pre>
            </article>
            <!-- Fin de la lista de productos en el carrito -->
        </main>
        <!-- Fin de la columna para el carrito de compras -->

        <!-- Inicio de la columna para el resumen del pedido -->
        <main class="carrito_pedido">
            <!-- Título del resumen del pedido -->
            <h2 class="carrito_titulo">Resumen del pedido</h2>
            <hr>
            <!-- Inicio del contenido del resumen del pedido -->
            <div class="resumen_pedido">
                <!-- Campo para ingresar un cupón -->
                <div class="campo_cupon">
                    <!-- Formulario para ingresar el cupón -->
                    <form method="POST" action="compras.php" style="display: flex;">
                        <input class="cupon" id="cupon" name="cupon" type="text" placeholder="Ingresar cupón" required autofocus>
                        <button id="aplicar_cupon">Aplicar</button>
                    </form>
                </div>
                <!-- Muestra el cupón ingresado -->
                <?php
                echo "<h1 style='color: white; font-size: 15px;'>" . $_SESSION['cupon'] . " </h1>";
                ?>
                <!-- Detalles del pedido -->
                <div class="resumen_item">
                    <span>Subtotal:</span>
                    <span id="subtotal">$<?php echo number_format($subtotal, 2, '.', ','); ?></span>
                </div>
                <div class="resumen_item">
                    <span>Descuento:</span>
                    <span id="descuento">$<?php echo isset($_SESSION["descuento"]) ? number_format($_SESSION["descuento"], 2, '.', ',') : "0.00"; ?></span>
                </div>
                <div class="resumen_item">
                    <span>Total:</span>
                    <span id="total">$<?php echo number_format($nuevoTotal, 2, '.', ','); ?></span>
                </div>
                <!-- Botones para continuar con el proceso de compra -->
                <div class="botones">
                    <a href="compras_perfil.php">
                        <button id="agregar_productos">Continuar</button></a>
                    <a href="index.php">
                        <button id="siguiente_fase">Agregar más productos</button></a>
                </div>
            </div>
            <!-- Fin del contenido del resumen del pedido -->
        </main>
        <!-- Fin de la columna para el resumen del pedido -->
    </section>
    <!-- Fin de la sección principal -->
    <hr>
    <!-- Inicio del pie de página -->
    <footer>
        <!-- Contenido del pie de página -->
        <?php
        // Incluye el contenido del archivo 'piePagina.html' una sola vez
        include_once 'piePagina.html'
        ?>
    </footer>
    <!-- Fin del pie de página -->
</body>

</html>