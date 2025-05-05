<?php
$conn = new mysqli("localhost", "root", "", "db_recursos", 3305);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = "";

// Guardar configuración
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre_sistema = $_POST["nombre_sistema"];
    $moneda = $_POST["moneda"];
    $tema = $_POST["tema"];

    $stmt = $conn->prepare("REPLACE INTO configuracion (clave, valor) VALUES 
        ('nombre_sistema', ?),
        ('moneda', ?),
        ('tema', ?)");
    $stmt->bind_param("sss", $nombre_sistema, $moneda, $tema);
    
    if ($stmt->execute()) {
        $mensaje = "Configuración actualizada correctamente.";
    } else {
        $mensaje = "Error al guardar configuración.";
    }
    $stmt->close();
}

// Obtener configuración actual
$valores = [
    'nombre_sistema' => '',
    'moneda' => '',
    'tema' => ''
];
$result = $conn->query("SELECT * FROM configuracion");
while ($row = $result->fetch_assoc()) {
    $valores[$row['clave']] = $row['valor'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 50px;
        }
        .form-container {
            background: white;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .btn {
            background-color: #c88f47;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #b67c3a;
        }
        .message {
            margin-bottom: 15px;
            color: green;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Configuración del Sistema</h2>

    <?php if ($mensaje): ?>
        <p class="message"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre del Sistema:</label>
        <input type="text" name="nombre_sistema" value="<?php echo htmlspecialchars($valores['nombre_sistema']); ?>" required>

        <label>Moneda (Ej: Bs, $):</label>
        <input type="text" name="moneda" value="<?php echo htmlspecialchars($valores['moneda']); ?>" required>

        <label>Color de Tema:</label>
        <select name="tema">
            <option value="claro" <?php if ($valores['tema'] == 'claro') echo 'selected'; ?>>Claro</option>
            <option value="oscuro" <?php if ($valores['tema'] == 'oscuro') echo 'selected'; ?>>Oscuro</option>
        </select>

        <button type="submit" class="btn">Guardar Configuración</button>
        <a href="dashboard.php" class="btn" style="margin-top: 20px;">← Volver al Dashboard</a>

    </form>

</div>
</body>
</html>
