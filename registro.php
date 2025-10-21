<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $usuario = $_POST['usuario'];
  $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
  $rol = $_POST['rol'];
  $anio = $_POST['anio'] ?? null;

  if ($rol === 'profesor') {
    $codigo_verificacion = $_POST['codigo'];
    if ($codigo_verificacion !== 'PROA2025') {
      echo "<script>alert('Código de verificación incorrecto');</script>";
    } else {
      $conn->query("INSERT INTO usuarios (nombre, usuario, clave, rol, anio) VALUES ('$nombre','$usuario','$clave','$rol',NULL)");
      echo "<script>alert('Profesor registrado con éxito');window.location='index.php';</script>";
    }
  } else {
    $conn->query("INSERT INTO usuarios (nombre, usuario, clave, rol, anio) VALUES ('$nombre','$usuario','$clave','$rol','$anio')");
    echo "<script>alert('Alumno registrado con éxito');window.location='index.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<style>
body {
  background: linear-gradient(to bottom, #003366, #007bff);
  font-family: Arial, sans-serif;
  color: white;
  text-align: center;
  padding: 30px;
}
form {
  background: rgba(255,255,255,0.1);
  padding: 30px;
  border-radius: 15px;
  display: inline-block;
}
input, select {
  margin: 10px;
  padding: 8px;
  border-radius: 8px;
  border: none;
}
button {
  background: #00bfff;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
}
</style>
<script>
function toggleExtraFields() {
  const rol = document.querySelector('input[name="rol"]:checked').value;
  document.getElementById('anioDiv').style.display = rol === 'alumno' ? 'block' : 'none';
  document.getElementById('codigoDiv').style.display = rol === 'profesor' ? 'block' : 'none';
}
</script>
</head>
<body>
<h2>Crear cuenta</h2>
<form method="POST">
  <input type="text" name="nombre" placeholder="Nombre completo" required><br>
  <input type="text" name="usuario" placeholder="Usuario" required><br>
  <input type="password" name="clave" placeholder="Contraseña" required><br>

  <label><input type="radio" name="rol" value="alumno" onclick="toggleExtraFields()" required> Alumno</label>
  <label><input type="radio" name="rol" value="profesor" onclick="toggleExtraFields()"> Profesor</label>

  <div id="anioDiv" style="display:none;">
    <select name="anio">
      <option value="">Selecciona tu año</option>
      <option value="1">1° Año</option>
      <option value="2">2° Año</option>
      <option value="3">3° Año</option>
      <option value="4">4° Año</option>
      <option value="5">5° Año</option>
      <option value="6">6° Año</option>
    </select>
  </div>

  <div id="codigoDiv" style="display:none;">
    <input type="text" name="codigo" placeholder="Código de verificación">
  </div>

  <br>
  <button type="submit">Registrarme</button>
</form>
</body>
</html>
