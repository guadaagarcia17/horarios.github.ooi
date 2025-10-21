<?php
include('conexion.php');

$resultado = $conn->query("SELECT * FROM horarios ORDER BY FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes'), hora");

while($fila = $resultado->fetch_assoc()) {
  echo "<tr>
          <td>{$fila['dia']}</td>
          <td>{$fila['hora']}</td>
          <td>{$fila['materia']}</td>
          <td>{$fila['profesor']}</td>
          <td>{$fila['aula']}</td>
        </tr>";
}