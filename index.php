<?php 
session_start();
if(!isset($_SESSION['nombre'])) {
  header("Location: Login.php");
}
?>
<?php
session_start();
if(isset($_GET["nombre"])){
$_SESSION['nombre']=$_GET['nombre'];
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
    <link href="css/style_index.css" rel="stylesheet" />

    <!-- Título de la página -->
    <title>Azabache Fast Food</title>
</head>

<body>

    <header class="header">

        <?php
        include_once 'menu.html'
    ?>

    </header>

    <!-- Barra de navegación principal -->
    <nav class="container">
        <!-- Slider de imágenes -->
        <div class="container_slider">
            <ul class="container_slider__list">
                <li class="container_slider__item">
                    <img class="container_slider__img" src="imagenes/hamburguesa2.jpg" alt="Hamburguesa 2" />
                </li>
                <li class="container_slider__item">
                    <img class="container_slider__img" src="imagenes/hamburguesa4.jpg" alt="Hamburguesa 3" />
                </li>
                <li class="container_slider__item">
                    <img class="container_slider__img" src="imagenes/hamburguesa3.jpg" alt="Hamburguesa 4" />
                </li>
            </ul>
        </div>
        <!-- Sección lateral -->
        <section class="container_lateral">
            <!-- Imagen lateral -->
            <img class="container_lateral_imagen" src="imagenes/hamburguesa1.jpg" alt="..." />
            <!-- Botón para comprar -->
            <a class="container_lateral_boton" href="index.html"><button class="boton" type="button">Comprar
                    Ahora</button></a>
        </section>
    </nav>

    <!-- Sección de productos -->
    <section class="productos">
        <div class="productos_titulo">
            <div class="productos_texto">Productos</div>
            <a class="productos_texto" href="index.php">Ver Todo</a>
        </div>
        <!-- Contenedor de las imágenes de los productos -->
        <div class="productos_cartas">
            <div class="fila_productos">
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/clasica.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/pollo.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/tocineta.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
            </div>

            <div class="fila_productos">
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/dobleCarne.jpg" alt />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/tripleCarne.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
                <div class="producto">
                    <img class="productos_imagen" src="imagenes/dobleCarnePollo.jpg" alt="..." />
                    <button class="carrito_boton">Añadir al carrito</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Separador horizontal -->
    <hr />

    <!-- Pie de página -->
    <footer>
        <!-- Contenido del pie de página -->
        <?php
        include_once 'piePagina.html'
    ?>
    </footer>
</body>

</html>