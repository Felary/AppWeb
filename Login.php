<?php
include("./conexion.php");
if (isset($_POST["username"])) {
  $user = $_POST["username"];
  $password = $_POST["password"];
  $sentencia = $conexion->prepare("SELECT * FROM registro WHERE usuario = ? AND contraseña = ?");
  $sentencia->execute([$user, $password]);
  $resultado = $sentencia->fetch();  
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
   <!-- Encabezado -->
   <header class="header">
    <!-- Logo del sitio -->
    <a href="index.html"><img class="header_logo" src="imagenes/azabache_Logo.png" alt /></a>


    <!-- Menú de navegación -->
    <div class="header_menu">
      <a class="header_items" href="registro.php">Registro</a>
      <a class="header_items" href="Login.php">Iniciar Sesion</a>
      
    </div>
  </header>
  <div class="login-container">
    <h2>Iniciar Sesión</h2>
      <form action="Login.php" method="post">
      <div class="input-group">
        <label for="username">Usuario</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" id="ingresar">Ingresar</button>
    </form>
  </div>
</body>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: black;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
    text-align: center;
    color: #333;
  }

  form {
    display: flex;
    flex-direction: column;
  }

  .input-group {
    margin-bottom: 15px;
  }

  label {
    font-weight: bold;
  }

  input[type="text"],
  input[type="password"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }

  button {
    padding: 10px 20px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 3px;
    cursor: pointer;
  }

  button:hover {
    background-color: #0056b3;
  }
</style>

</html>