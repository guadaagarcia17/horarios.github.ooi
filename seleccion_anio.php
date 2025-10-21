<?php
session_start();
if ($_SESSION['rol'] != 'profesor') {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['anio_editar'] = $_POST['anio'];
    header("Location: horario.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Seleccionar Año</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
  <img src="img/logo.png" class="logo">
  <h2 style="color:white;">Seleccionar Año a Editar</h2>
</div>
<div class="container-wrapper">
  <div class="container">
    <form method="POST">
      <label>Seleccioná el año que querés editar:</label><br><br>
      <select name="anio">
        <option value="1">1º Año</option>
        <option value="2">2º Año</option>
        <option value="3">3º Año</option>
        <option value="4">4º Año</option>
        <option value="5">5º Año</option>
        <option value="6">6º Año</option>
      </select><br><br>
      <button type="submit" class="btn">Entrar</button>
    </form>
  </div>
</div>
</body>
</html>
