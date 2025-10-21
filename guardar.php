<?php
session_start();
if ($_SESSION['rol'] !== 'profesor') {
    exit("No autorizado");
}
include "conexion.php";

if (isset($_POST['id']) && isset($_POST['contenido']) && isset($_POST['anio'])) {
    $id = $_POST['id'];
    $contenido = $_POST['contenido'];
    $anio = intval($_POST['anio']);

    $sql = "INSERT INTO horarios (id, anio, contenido) VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE contenido=VALUES(contenido)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $id, $anio, $contenido);
    echo $stmt->execute() ? "OK" : "Error";
}
$conn->close();
?>
