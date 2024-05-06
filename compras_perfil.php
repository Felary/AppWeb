<?php
session_start();
if(!isset($_SESSION['nombre'])){
    header("Location: login.php");
}
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
        <a href="index.html"><img class="header_logo" src="imagenes/azabache_Logo.png" alt></a>
        <div class="header_menu">
            <a class="header_items" href="index.html">Inicio</a>
            <a class="header_items" href="#pie_pagina">Contactanos</a>
            <a class="header_items" href="compras.html"><img class="header_imagen" src="imagenes/carrito.png" alt>
                Carrito</a>
            <a class="header_items" href="productos.html">
                Menú <img class="header_imagen" src="imagenes/menu.png" alt>
            </a>
        </div>
    </header>

    <!-- Barra de navegación para la sección de acceso -->
    <nav class="accesos">
        <div class="casilla_activa">
            <a class="acceso_items" href="compras.html">Carrito</a>
        </div>

        <!-- Otras opciones de acceso -->
        <div class="casilla_activa">
            <a class="acceso_items" href="compras_perfil.html">Perfil</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras_perfil.html">Entrega</a>
        </div>
        <!-- Otras opciones de acceso -->
        <div class="casilla_inactiva">
            <a class="acceso_items" href="compras_perfil.html">Pago</a>
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
                    <input class="cupon" id="cupon" name="cupon" type="text" placeholder="Ingresar cupón">
                    <button id="aplicar_cupon">Aplicar</button>
                </div>
                <!-- Detalles del pedido -->
                <div class="resumen_item">
                    <span>Subtotal:</span>
                    <span id="subtotal">$12.500</span>
                </div>
                <div class="resumen_item">
                    <span>Descuento:</span>
                    <span id="descuento">$0.00</span>
                </div>
                <div class="resumen_item">
                    <span>Total:</span>
                    <span id="total">$12.500</span>
                </div>
                <!-- Botones para continuar con el proceso de compra -->
                <div class="botones">
                    <a href="compras_perfil.html">
                        <button id="agregar_productos">Continuar</button></a>
                    <a href="compras.html">
                        <button id="siguiente_fase">Volver</button></a>
                </div>
            </div>
        </main>

    </section>
    <aside></aside>
    <hr>
    <footer>
        <div class="footer" id="pie_pagina">
            <div>
                <h3 class="footer_titulo">Azabache Fast Food</h3>
                <img class="footer_logo" src="imagenes/azabache_Logo.png" alt>
            </div>
            <div class="footer_section">
                <h3 class="footer_titulo">Información</h3>
                <p class="footer_texto">
                    <img class="footer_imagen" src="imagenes/Ubicacion.png" alt>
                    Carrera 10 # 13B - 22
                </p>
                <p class="footer_texto">
                    <img class="footer_imagen" src="imagenes/whatsapp.png" alt> 321
                    456 7890
                </p>
            </div>
            <div class="footer_section">
                <h3 class="footer_titulo">Enlaces rápidos</h3>
                <ul>
                    <li><a class="footer_enlaces" href="index.html">Inicio</a></li>
                    <li>
                        <a class="footer_enlaces" href="productos.html">Productos</a>
                    </li>
                    <li><a class="footer_enlaces" href="compras.html">Carrito</a></li>
                    <li><a class="footer_enlaces" href="#pie_pagina">Contactos</a></li>
                </ul>
            </div>
        </div>
        <div class="footer_copyright">
            <p>&copy; 2022 Azabache Fast Food. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>