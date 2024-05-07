<?php
session_start();
if(!isset($_SESSION['nombre'])){
    header("Location: login.php");
}
?>
<?php
    $subtotal = isset($_SESSION["subtotal"]) ? $_SESSION["subtotal"] : 0;
    $descuento = isset($_SESSION["descuento"]) ? $_SESSION["descuento"] : 0;
    $codigo = isset($_SESSION["codigo"]) ? $_SESSION["codigo"] : 0;    
    $nuevoTotal = $subtotal - $descuento;   
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagenes/icono_hamburguesa.ico" rel="shor cut icon">
    <link href="css/style_perfil.css" rel="stylesheet">
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
        <div class="casilla_activa">
            <a class="acceso_items" href="compras.php">Carrito</a>
        </div>

        <!-- Otras opciones de acceso -->
        <div class="casilla_activa">
            <a class="acceso_items" href="compras_perfil.php">Perfil</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras_perfil.php">Entrega</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras_perfil.php">Pago</a>
        </div>
    </nav>

    <section class="barra">
        <main class="carrito">
            <h2 class="carrito_titulo">Identificacion</h2>
            <pre class="notas">
        Solicitamos únicamente la información 
        esencial para la finalización de la compra.
        </pre>


            <div class="formulario">
                <p>
                    NOMBRE
                </p>
                <p class="asterisco">*</p>

            </div>
            <input class="cupon1" id="cupon" name="nombre" type="text" placeholder="Ingresar Nombre">
            <div class="formulario">
                <p>
                    APELLIDO
                </p>
                <p class="asterisco">*</p>

            </div>
            <input class="cupon1" id="cupon" name="apellido" type="text" placeholder="Ingresar Apellido">
            <div class="formulario">
                <p>
                    TELEFONO
                </p>
                <p class="asterisco">*</p>

            </div>
            <input class="cupon1" id="cupon" name="telefono" type="tel" placeholder="Ingrese su Numero">
            <div class="formulario">
                <p class="">
                    CORREO
                </p>
                <p class="asterisco">*</p>

            </div>
            <input class="cupon1" id="cupon" name="correo" type="email" placeholder="Ingresar Correo">
            <div class="formulario">
                <p>
                    DIRECCIÓN
                </p>
                <p class="asterisco">*</p>

            </div>
            <input class="cupon1" id="cupon" name="direccion" type="text" placeholder="Ingrese su direccion">

        </main>

        <main class="carrito_envio">
            <h2 class="carrito_titulo">Envio </h2>
            <pre class="notas">
                Se continuaracon el proceso
                 una vez acabe esta seccion
        </pre>


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
                    <?php
                    echo "<h1 style='color: white; font-size: 20px;'>".$_SESSION['cupon']." </h1>";
                    ?>
                    <input class="cupon" id="cupon" name="cupon" type="text" placeholder="Ingresar cupón"
                        value="<?php echo isset($_SESSION["codigo"]) ? $_SESSION["codigo"] : ''; ?>"
                        <?php echo isset($_SESSION["descuento"]) ? 'disabled' : ''; ?>>

                </div>

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
                    <a href="compras.php">
                        <button id="siguiente_fase">Volver</button></a>
                </div>
            </div>
        </main>

    </section>
    <aside></aside>
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