<?php
$servername = "localhost"; // Servidor local
$username = "root";        // Usuario local
$password = "";            // Contraseña local (vacía por defecto en XAMPP)
$dbname = "horarios_bd";   // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
