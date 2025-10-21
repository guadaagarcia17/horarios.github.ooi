<?php
session_start();
include('conexion.php');

// Si no hay sesión, redirige a index
if (!isset($_SESSION['usuario'])) {
  header("Location: index.php");
  exit();
}

$rol = $_SESSION['rol'] ?? 'alumno';
$nombre = $_SESSION['nombre'] ?? 'Invitado';

// Procesar nuevo horario (solo profesores)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $rol === 'profesor') {
  $codigo = $_POST['codigo'];
  $materia = $_POST['materia'];
  $profesor = $_POST['profesor'];
  $aula = $_POST['aula'];
  $dia = $_POST['dia'];
  $hora = $_POST['hora'];

  $conn->query("INSERT INTO horarios (codigo, materia, profesor, aula, dia, hora)
                VALUES ('$codigo','$materia','$profesor','$aula','$dia','$hora')");
  header("Location: horario.php"); // recarga la página
  exit();
}

// Obtener horarios
$resultado = $conn->query("SELECT * FROM horarios ORDER BY FIELD(dia,'Lunes','Martes','Miércoles','Jueves','Viernes'), hora");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Horarios</title>
<style>
body {
  background: linear-gradient(to bottom, #003366, #007bff);
  color: white;
  font-family: Arial, sans-serif;
  text-align: center;
  margin: 0;
  padding: 0;
}
header {
  background: rgba(255,255,255,0.2);
  padding: 15px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
button {
  background: #00bfff;
  color: white;
  border: none;
  padding: 8px 14px;
  border-radius: 8px;
  cursor: pointer;
  margin: 5px;
}
button:hover { background: #0099cc; }

table {
  margin: 20px auto;
  background: white;
  color: black;
  border-collapse: collapse;
  width: 90%;
  border-radius: 10px;
  overflow: hidden;
}
th, td {
  border: 1px solid #ccc;
  padding: 8px;
}
h2 {
  margin-top: 30px;
  background: rgba(255,255,255,0.1);
  display: inline-block;
  padding: 10px 20px;
  border-radius: 12px;
}
form {
  margin-top: 20px;
  background: rgba(255,255,255,0.15);
  padding: 20px;
  border-radius: 10px;
  display: inline-block;
}
input, select {
  margin: 6px;
  padding: 6px;
  border-radius: 6px;
  border: none;
}
</style>
</head>
<body>
<header>
  <h3>Horario de 6° Año</h3>
  <div>
    <span>Bienvenido <?= htmlspecialchars($nombre) ?> (<?= htmlspecialchars($rol) ?>)</span>
    <button onclick="window.location.href='logout.php'">Salir</button>
  </div>
</header>

<table>
<tr><th>Día</th><th>Hora</th><th>Materia</th><th>Profesor</th><th>Aula</th></tr>
<?php while($fila=$resultado->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars($fila['dia']) ?></td>
<td><?= htmlspecialchars($fila['hora']) ?></td>
<td><?= htmlspecialchars($fila['materia']) ?></td>
<td><?= htmlspecialchars($fila['profesor']) ?></td>
<td><?= htmlspecialchars($fila['aula']) ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php if($rol === 'profesor'): ?>
<h3>Agregar nuevo horario</h3>
<form method="POST">
  <input type="text" name="codigo" placeholder="Código (L9, M10...)" required>
  <input type="text" name="materia" placeholder="Materia" required>
  <input type="text" name="profesor" placeholder="Profesor" required>
  <input type="text" name="aula" placeholder="Aula" required>
  <select name="dia" required>
    <option value="">Día</option>
    <option>Lunes</option><option>Martes</option><option>Miércoles</option><option>Jueves</option><option>Viernes</option>
  </select>
  <input type="text" name="hora" placeholder="Hora (08:00-09:20)" required>
  <br>
  <button type="submit">Agregar</button>
  <button type="button" onclick="window.history.back()">Volver atrás</button>
</form>
<?php else: ?>
<button onclick="window.history.back()">Volver atrás</button>
<?php endif; ?>

</body>
</html>
