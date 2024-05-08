<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}
?>
<?php
include_once 'conexion.php';
$_SESSION["cupon"] = "No se ha aplicado ningún cupón";
$_SESSION["subtotal"] = 12500;
if (isset($_POST["cupon"])) {
   
  $cupon = $_POST["cupon"];
  $sentencia = $conexion->prepare("SELECT * FROM cupones WHERE codigo = ?");
  $sentencia->execute([$cupon]);
  
  $resultado = $sentencia->fetch();  
  if ($resultado != false) {
    $_SESSION["codigo"] = $resultado["codigo"];
    $_SESSION["descuento"] = $resultado["descuento"];
    $_SESSION["cupon"] = "El cupón es válido";   
} 
}
?>
<?php
    $subtotal = 12500; // Reemplaza esto con el total real
    $descuento = isset($_SESSION["descuento"]) ? $_SESSION["descuento"] : 0;
    $nuevoTotal = $subtotal - $descuento;
   ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagenes/icono_hamburguesa.ico" rel="shor cut icon"> <!-- Icono del sitio -->
    <link href="css/style_compras.css" rel="stylesheet"> <!-- Enlace a la hoja de estilos CSS -->
    <title>Azabache Fast Food</title> <!-- Título de la página -->
</head>

<body>
    <!-- Encabezado de la página -->
    <header class="header">
        <?php
        
        include_once 'menuSecundario.html'
    ?>
    </header>

    <!-- Barra de navegación para la sección de acceso -->
    <nav class="accesos">
        <div class="casilla_activa">
            <a class="acceso_items" href="compras.php">Carrito</a>
        </div>

        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras_perfil.php">Perfil</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras.php">Entrega</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras.php">Pago</a>
        </div>
    </nav>

    <!-- Sección principal con dos columnas: Carrito de compras y Resumen del pedido -->
    <section class="barra">
        <!-- Columna para el carrito de compras -->
        <main class="carrito">
            <!-- Título del carrito -->
            <h2 class="carrito_titulo">Mi carrito de compras</h2>
            <hr>
            <!-- Lista de productos en el carrito -->
            <article class="carrito_cartas">
                <!-- Producto en el carrito -->
                <input type="checkbox" class="check" checked disabled>
                <img class="carrito_imagen" src="imagenes/hamburguesa.png" alt>
                <pre
                    class="carrito_texto">hamburguesa Clasica                                       12.500 $<img class="carrito_imagen2" src="imagenes/basura.png" alt></pre>
            </article>
        </main>

        <!-- Columna para el resumen del pedido -->
        <main class="carrito_pedido">
            <!-- Título del resumen del pedido -->
            <h2 class="carrito_titulo">Resumen del pedido</h2>
            <hr>
            <!-- Contenido del resumen del pedido -->
            <div class="resumen_pedido">
                <!-- Campo para ingresar un cupón -->
                <div class="campo_cupon">

                    <form method="POST" action="compras.php" style="display: flex;">
                        <input class="cupon" id="cupon" name="cupon" type="text" placeholder="Ingresar cupón" required
                            autofocus>
                        <button id="aplicar_cupon">Aplicar</button>
                    </form>
                </div>
                <?php
                    echo "<h1 style='color: white; font-size: 15px;'>".$_SESSION['cupon']." </h1>";
                    ?>
                <!-- Detalles del pedido -->
                <div class="resumen_item">
                    <span>Subtotal:</span>
                    <span id="subtotal">$<?php echo number_format($subtotal, 2, '.', ','); ?></span>
                </div>
                <div class="resumen_item">
                    <span>Descuento:</span>
                    <span
                        id="descuento">$<?php echo isset($_SESSION["descuento"]) ? number_format($_SESSION["descuento"], 2, '.', ',') : "0.00"; ?></span>
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
        </main>
    </section>
    <hr>
    <!-- Pie de página -->
    <footer>
        <!-- Contenido del pie de página -->
        <?php
        include_once 'piePagina.html'
    ?>
    </footer>
</body>

</html>