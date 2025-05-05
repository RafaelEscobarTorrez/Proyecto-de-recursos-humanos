<?php
include("conexion.php");
$mensaje = "";

// Obtener ID desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;
    $nombre = $_POST["nombre_ingrediente"];
    $tipo = $_POST["tipo"];
    $unidad = $_POST["unidad"];
    $precio = $_POST["precio_unitario"];

    if (!empty($nombre) && !empty($tipo) && !empty($unidad) && is_numeric($precio) && $id > 0) {
        $stmt = $conexion->prepare("UPDATE ingredientes SET nombre_ingrediente=?, tipo=?, unidad=?, precio_unitario=? WHERE id=?");
        $stmt->bind_param("sssdi", $nombre, $tipo, $unidad, $precio, $id);

        if ($stmt->execute()) {
            $mensaje = "Ingrediente actualizado correctamente.";
        } else {
            $mensaje = "Error al actualizar: " . $conexion->error;
        }

        $stmt->close();
    } else {
        $mensaje = "Completa todos los campos correctamente.";
    }
    echo "<meta http-equiv='refresh' content='0;url=main.php'>";
    exit();
}


// Obtener los datos del ingrediente actual
$stmt = $conexion->prepare("SELECT * FROM ingredientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$ingrediente = $result->fetch_assoc();
$stmt->close();
?>

<link rel="stylesheet" href="./styles/edit_ingredient.css">

<div class="form-container">
    <h2>Editar Ingrediente</h2>

    <?php if ($mensaje): ?>
        <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <form action="edit_ingredient.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre_ingrediente" value="<?php echo htmlspecialchars($ingrediente['nombre_ingrediente']); ?>" required>

        <label>Tipo:</label>
        <input type="text" name="tipo" value="<?php echo htmlspecialchars($ingrediente['tipo']); ?>" required>

        <label>Unidad:</label>
        <input type="text" name="unidad" value="<?php echo htmlspecialchars($ingrediente['unidad']); ?>" required>

        <label>Precio Unitario (Bs):</label>
        <input type="number" step="0.01" name="precio_unitario" value="<?php echo htmlspecialchars($ingrediente['precio_unitario']); ?>" required>

        <input type="hidden" name="id" value="<?php echo $ingrediente['id']; ?>">

        <button type="submit" class="btn">Guardar Cambios</button>
    </form>

</div>
