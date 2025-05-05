<?php
include("conexion.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conexion->prepare("DELETE FROM ingredientes WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ingredients.php");
        exit;
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}

echo "<meta http-equiv='refresh' content='0;url=main.php'>";
exit();
?>