<?php
include("./conexion.php");
if(isset($_POST)) {
  $user= $_POST["username"];
  $email= $_POST["email"];
  $password=$_POST["password"];

  $sentencia = $conexion->prepare("insert into usuario (usuario, correo, contraseña)values(?,?,?);");
        $resultado = $sentencia->execute([$user, $email, $password]);
        if ($resultado == true) {
          echo "REGISTRADO CORRECTAMENTE";
        }
}




?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="register-container">
    <h2>Registro</h2>
    <form action="registro.php" method="post">
      <div class="input-group">
        <label for="username">Usuario</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="email">Correo</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Registrarse</button>
    </form>
  </div>
</body>
<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.register-container {
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
input[type="email"],
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
