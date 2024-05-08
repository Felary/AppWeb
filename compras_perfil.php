<?php
// Inicia una nueva sesión o reanuda la existente
session_start();
// Si el usuario no está logueado, redirige a la página de login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

// Incluye el archivo de conexión a la base de datos
include("./conexion.php");
// Establece un mensaje en la sesión
$_SESSION['mensaje'] = "Se continuara con el proceso 
            una vez acabe esta seccion";

try {
    // Si el método de la solicitud es POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoge los datos del formulario
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
        // Verifica si el teléfono es un número
        if (!is_numeric($telefono)) {
            throw new Exception("El teléfono debe ser un número");
        }

        // Prepara una consulta SQL para insertar los datos en la base de datos
        $sentencia = $conexion->prepare("INSERT INTO datos (nombre, apellido, telefono, correo, direccion) VALUES (?, ?, ?, ?, ?)");
        // Ejecuta la consulta
        $sentencia->execute([$nombre, $apellido, $telefono, $correo, $direccion]);

        // Si se insertaron filas en la base de datos
        if ($sentencia->rowCount() > 0) {
            // Establece un mensaje en la sesión
            $_SESSION['mensaje'] = "Datos insertados correctamente";
        } else {
            // Lanza una excepción
            throw new Exception("Error al insertar los datos");
        }
    }
} catch (Exception $e) {
    // Si se produce una excepción, establece el mensaje de la excepción en la sesión
    $_SESSION['mensaje'] = $e->getMessage();
}

// Recoge los datos de la sesión
$subtotal = isset($_SESSION["subtotal"]) ? $_SESSION["subtotal"] : 0;
$descuento = isset($_SESSION["descuento"]) ? $_SESSION["descuento"] : 0;
$codigo = isset($_SESSION["codigo"]) ? $_SESSION["codigo"] : 0;
// Calcula el nuevo total
$nuevoTotal = $subtotal - $descuento;
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Define el conjunto de caracteres para el documento -->
    <meta charset="UTF-8">
    <!-- Controla el diseño en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlace al icono que se muestra en la pestaña del navegador -->
    <link href="imagenes/icono_hamburguesa.ico" rel="shor cut icon">
    <!-- Enlace al archivo CSS que define los estilos para la página -->
    <link href="css/style_perfil.css" rel="stylesheet">
    <!-- Título de la página que se muestra en la pestaña del navegador -->
    <title>Azabache Fast Food</title>
</head>

<body>
    <!-- Inicio de la sección de encabezado con la clase "header" -->
    <header class="header">

        <?php
        // Inclusión del archivo 'menuSecundario.html' en el encabezado
        // 'include_once' garantiza que el archivo se incluya solo una vez
        include_once 'menuSecundario.html'
        ?>

        <!-- Fin de la sección de encabezado -->
    </header>

    <!-- Inicio de la barra de navegación con la clase "accesos" -->
    <nav class="accesos">
        <!-- Opción activa en la barra de navegación que enlaza a la página de "Carrito" -->
        <div class="casilla_activa">
            <a class="acceso_items" href="compras.php">Carrito</a>
        </div>

        <!-- Opción activa en la barra de navegación que enlaza a la página de "Perfil" -->
        <div class="casilla_activa">
            <a class="acceso_items" href="compras_perfil.php">Perfil</a>
        </div>
        <!-- Opción inactiva en la barra de navegación que enlaza a la página de "Entrega" -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras_perfil.php">Entrega</a>
        </div>
        <!-- Opción inactiva en la barra de navegación que enlaza a la página de "Pago" -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras_perfil.php">Pago</a>
        </div>
        <!-- Fin de la barra de navegación -->
    </nav>

    <!-- Inicio de la sección con la clase "barra" -->
    <section class="barra">
        <!-- Inicio del bloque principal con la clase "carrito" -->
        <main class="carrito">
            <!-- Título de la sección -->
            <h2 class="carrito_titulo">Identificacion</h2>
            <!-- Notas de la sección -->
            <pre class="notas">
                Solicitamos únicamente la información 
                esencial para la finalización de la compra.
            </pre>
            <!-- Inicio del formulario que se envía a "compras_perfil.php" -->
            <form action="compras_perfil.php" method="post">
                <!-- Bloque de entrada para el nombre -->
                <div class="formulario">
                    <p>NOMBRE</p>
                    <p class="asterisco">*</p>
                </div>
                <input class="cupon1" id="cupon" name="nombre" type="text" placeholder="Ingresar Nombre" required>
                <!-- Bloque de entrada para el apellido -->
                <div class="formulario">
                    <p>APELLIDO</p>
                    <p class="asterisco">*</p>
                </div>
                <input class="cupon1" id="cupon" name="apellido" type="text" placeholder="Ingresar Apellido" required>
                <!-- Bloque de entrada para el teléfono -->
                <div class="formulario">
                    <p>TELEFONO</p>
                    <p class="asterisco">*</p>
                </div>
                <input class="cupon1" id="cupon" name="telefono" type="tel" placeholder="Ingrese su Numero" required>
                <!-- Bloque de entrada para el correo -->
                <div class="formulario">
                    <p>CORREO</p>
                    <p class="asterisco">*</p>
                </div>
                <input class="cupon1" id="cupon" name="correo" type="email" placeholder="Ingresar Correo" required>
                <!-- Bloque de entrada para la dirección -->
                <div class="formulario">
                    <p>DIRECCIÓN</p>
                    <p class="asterisco">*</p>
                </div>
                <input class="cupon1" id="cupon" name="direccion" type="text" placeholder="Ingrese su direccion" required>
                <!-- Botón para enviar el formulario -->
                <button id="siguiente_fase" type="submit" name="continuar">Continuar</button>
            </form>
        </main>
        <!-- Fin del bloque principal -->

        <!-- Inicio del bloque principal para el envío -->
        <main class="carrito_envio">
            <!-- Título de la sección -->
            <h2 class="carrito_titulo">Envio </h2>
            <!-- Notas de la sección -->
            <pre class="notas">
                <?php
                // Muestra el mensaje almacenado en la sesión
                echo $_SESSION['mensaje'];
                ?>
            </pre>
        </main>
        <!-- Fin del bloque principal para el envío -->

        <!-- Inicio del bloque principal para el resumen del pedido -->
        <main class="carrito_pedido">
            <!-- Título del resumen del pedido -->
            <h2 class="carrito_titulo">Resumen del pedido</h2>
            <hr>
            <!-- Contenido del resumen del pedido -->
            <div class="resumen_pedido">
                <!-- Campo para ingresar un cupón -->
                <div class="campo_cupon">
                    <?php
                    // Muestra el cupón almacenado en la sesión
                    echo "<h1 style='color: white; font-size: 20px;'>" . $_SESSION['cupon'] . " </h1>";
                    ?>
                    <input class="cupon" id="cupon" name="cupon" type="text" placeholder="sin cupon" disabled value="<?php echo isset($_SESSION["codigo"]) ? $_SESSION["codigo"] : ''; ?>" <?php echo isset($_SESSION["descuento"]) ? 'disabled' : ''; ?>>
                </div>

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
                <div class="botones" style="display: flex;">
                    <a href="compras.php">
                        <button id="siguiente_fase">Volver</button></a>
                </div>
            </div>
        </main>
        <!-- Fin del bloque principal para el resumen del pedido -->
    </section>
    <!-- Fin de la sección -->

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