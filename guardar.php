<?php
include "conexion.php";

if (isset($_POST['id']) && isset($_POST['contenido'])) {
    $id = $_POST['id'];
    $contenido = $_POST['contenido'];

    $sql = "UPDATE horarios SET contenido=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $contenido, $id);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Error al guardar: " . $conn->error;
    }
}
$conn->close();
?>
