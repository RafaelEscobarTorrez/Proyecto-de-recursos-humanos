<?php
include("conexion.php");
$mensaje = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre_ingrediente"];
    $tipo = $_POST["tipo"];
    $unidad = $_POST["unidad"];
    $precio = $_POST["precio_unitario"];

    // Validación básica
    if (!empty($nombre) && !empty($tipo) && !empty($unidad) && is_numeric($precio)) {
        $stmt = $conexion->prepare("INSERT INTO ingredientes (nombre_ingrediente, tipo, unidad, precio_unitario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $nombre, $tipo, $unidad, $precio);
        
        if ($stmt->execute()) {
            $mensaje = "Ingrediente agregado exitosamente.";
        } else {
            $mensaje = "Error al agregar: " . $conexion->error;
        }

        $stmt->close();
    } else {
        $mensaje = "Por favor, completa todos los campos correctamente.";
    }
    echo "<meta http-equiv='refresh' content='0;url=main.php'>";
    exit();
}
?>
<link rel="stylesheet" href="./styles/new_ingredient.css">

<div class="form-container">
    <h2>Agregar Nuevo Ingrediente</h2>

    <?php if ($mensaje): ?>
        <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <form action="new_ingredient.php" method="POST">
        <label for="nombre_ingrediente">Nombre:</label>
        <input type="text" name="nombre_ingrediente" required>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" required>

        <label for="unidad">Unidad de Medida:</label>
        <input type="text" name="unidad" required>

        <label for="precio_unitario">Costo Unitario (Bs):</label>
        <input type="number" step="0.01" name="precio_unitario" required>

        <button type="submit" class="btn">Agregar Ingrediente</button>
    </form>
</div>

