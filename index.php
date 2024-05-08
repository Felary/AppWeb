<?php
// Inicia una nueva sesión o reanuda una existente
session_start();
// Si no hay una sesión de usuario establecida, redirige al usuario a la página de inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
?>
<?php
// Inicia una nueva sesión o reanuda una existente
session_start();
// Si se ha pasado un parámetro de usuario a través de GET, establece la sesión de usuario con ese valor
if (isset($_GET["usuario"])) {
    $_SESSION['usuario'] = $_GET['usuario'];
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos del documento -->
    <!-- Define la codificación de caracteres para el documento -->
    <meta charset="UTF-8" />
    <!-- Configura la vista del viewport para dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Enlaces a recursos externos -->
    <!-- Define el icono de favoritos para la página -->
    <link rel="shortcut icon" href="imagenes/icono_hamburguesa.ico" type="image/x-icon">
    <!-- Enlaza la hoja de estilos CSS para la página -->
    <link href="css/style_index.css" rel="stylesheet" />

    <!-- Título de la página -->
    <title>Azabache Fast Food</title>
</head>

<body>

    <<!-- Inicio de la cabecera de la página -->
<header class="header">
    <?php
    // Incluye el contenido del archivo 'menuSecundario.html' una sola vez
    include_once 'menuSecundario.html'
    ?>
</header>
<!-- Fin de la cabecera de la página -->

    <!-- Barra de navegación principal -->
    <!-- Inicio de la barra de navegación principal -->
    <nav class="container">
        <!-- Inicio del slider de imágenes -->
        <div class="container_slider">
            <!-- Lista de imágenes del slider -->
            <ul class="container_slider__list">
                <!-- Elemento de la lista con una imagen -->
                <li class="container_slider__item">
                    <!-- Imagen del slider con una descripción alternativa -->
                    <img class="container_slider__img" src="imagenes/hamburguesa2.jpg" alt="Hamburguesa 2" />
                </li>
                <!-- Elemento de la lista con una imagen -->
                <li class="container_slider__item">
                    <!-- Imagen del slider con una descripción alternativa -->
                    <img class="container_slider__img" src="imagenes/hamburguesa4.jpg" alt="Hamburguesa 3" />
                </li>
                <!-- Elemento de la lista con una imagen -->
                <li class="container_slider__item">
                    <!-- Imagen del slider con una descripción alternativa -->
                    <img class="container_slider__img" src="imagenes/hamburguesa3.jpg" alt="Hamburguesa 4" />
                </li>
            </ul>
        </div>
        <!-- Fin del slider de imágenes -->
        <!-- Inicio de la sección lateral -->
        <section class="container_lateral">
            <?php
            // Muestra un enlace a la página 'modificarPerfil.php' con un mensaje de bienvenida que incluye el nombre del usuario de la sesión
            echo "<a href='modificarPerfil.php' style='text-decoration: none;'><h1 style='color: white; font-size: 30px;'>Bienvenido " . $_SESSION['usuario'] . "</h1></a>";
            ?>
            <!-- Imagen lateral -->
            <img class="container_lateral_imagen" src="imagenes/hamburguesa1.jpg" alt="..." />
            <!-- Botón para comprar -->
            <a class="container_lateral_boton" href="compras.php">
                <button class="boton" type="button">Comprar Ahora</button>
            </a>
        </section>
        <!-- Fin de la sección lateral -->
    </nav>
    <!-- Fin de la barra de navegación principal -->

    <!-- Inicio de la sección de productos -->
    <section class="productos">
        <div class="productos_titulo">
            <!-- Título de la sección -->
            <div class="productos_texto">Productos</div>
            <!-- Enlace para ver todos los productos -->
            <a class="productos_texto" href="index.php">Ver Todo</a>
        </div>
        <!-- Contenedor de las imágenes de los productos -->
        <div class="productos_cartas">
            <!-- Fila de productos -->
            <div class="fila_productos">
                <!-- Producto individual con imagen y botón para añadir al carrito -->
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/clasica.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
                <!-- Producto individual con imagen y botón para añadir al carrito -->
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/pollo.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
                <!-- Producto individual con imagen y botón para añadir al carrito -->
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/tocineta.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
            </div>
            <!-- Fila de productos -->
            <div class="fila_productos">
                <!-- Producto individual con imagen y botón para añadir al carrito -->
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/dobleCarne.jpg" alt />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
                <!-- Producto individual con imagen y botón para añadir al carrito -->
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/tripleCarne.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
                <!-- Producto individual con imagen y botón para añadir al carrito -->
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/dobleCarnePollo.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin de la sección de productos -->

    <!-- Separador horizontal -->
    <hr />

    <!-- Inicio del pie de página -->
    <footer>
        <!-- Contenido del pie de página -->
        <?php
        // Incluye el contenido del archivo 'piePagina.html'
        include_once 'piePagina.html'
        ?>
    </footer>
    <!-- Fin del pie de página -->
</body>

</html>