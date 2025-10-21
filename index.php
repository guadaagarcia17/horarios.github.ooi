<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = $_POST['usuario'];
  $clave = $_POST['clave'];

  $res = $conn->query("SELECT * FROM usuarios WHERE usuario='$usuario'");
  if ($res->num_rows > 0) {
    $user = $res->fetch_assoc();
    if (password_verify($clave, $user['clave'])) {
      $_SESSION['usuario'] = $user['usuario'];
      $_SESSION['rol'] = $user['rol'];
      $_SESSION['nombre'] = $user['nombre'];
      $_SESSION['anio'] = $user['anio'];
      header("Location: horario.php");
      exit();
    } else {
      echo "<script>alert('Contraseña incorrecta');</script>";
    }
  } else {
    echo "<script>alert('Usuario no encontrado');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión</title>
<style>
body {
  background: linear-gradient(to bottom, #003366, #007bff);
  color: white;
  text-align: center;
  font-family: Arial, sans-serif;
  padding-top: 100px;
}
form {
  background: rgba(255,255,255,0.15);
  padding: 30px;
  display: inline-block;
  border-radius: 15px;
}
input {
  margin: 10px;
  padding: 8px;
  border: none;
  border-radius: 8px;
}
button {
  background: #00bfff;
  border: none;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
}
button:hover { background: #0099cc; }
</style>
</head>
<body>
<h2>Iniciar Sesión</h2>
<form method="POST">
  <input type="text" name="usuario" placeholder="Usuario" required><br>
  <input type="password" name="clave" placeholder="Contraseña" required><br>
  <button type="submit">Entrar</button>
</form>
<br>
<button onclick="window.location.href='registro.php'">Registrarse</button>
</body>
</html>
