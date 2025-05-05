<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "db_recursos", 3305);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Traer los lotes
$sql = "SELECT lotes.id, recetas.nombre_receta, lotes.fecha_inicio, lotes.fecha_fin, lotes.litros_producidos, lotes.estado, lotes.costo_total 
        FROM lotes 
        INNER JOIN recetas ON lotes.receta_id = recetas.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Producción - Lotes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        
        .container {
            margin-left: 260px; /* espacio para el aside */
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 16px;
            text-align: left;
        }
        th {
            background-color: #c88f47;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }
        tr:nth-child(even) {
            background-color: #f3e2c7;
        }
        .btn {
            background-color: #c88f47;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            display: inline-block;
        }
        .estado-en-proceso {
            color: orange;
            font-weight: bold;
        }
        .estado-terminado {
            color: green;
            font-weight: bold;
        }
        .estado-planificado {
            color: blue;
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #c88f47;
        }
    </style>
</head>
<body>

<aside>

<nav>
<a href="dashboard.php">Dashboard</a>
<a href="production.php">Production</a>
<a href="ingredients.php">Ingredients</a>
<a href="settings.php">Settings</a>
</nav>
</aside>

<div class="container">
    <h1>Lotes de Producción</h1>

    <a href="new_lote.php" class="btn">Nuevo Lote</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Receta</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Litros Producidos</th>
                <th>Estado</th>
                <th>Costo Total (Bs)</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_receta']); ?></td>
                        <td><?php echo $row['fecha_inicio']; ?></td>
                        <td><?php echo $row['fecha_fin']; ?></td>
                        <td><?php echo $row['litros_producidos']; ?> L</td>
                        <td>
                            <?php
                            $estado = strtolower($row['estado']);
                            if ($estado == 'en proceso') {
                                echo '<span class="estado-en-proceso">En Proceso</span>';
                            } elseif ($estado == 'terminado') {
                                echo '<span class="estado-terminado">Terminado</span>';
                            } elseif ($estado == 'planificado') {
                                echo '<span class="estado-planificado">Planificado</span>';
                            } else {
                                echo htmlspecialchars($row['estado']);
                            }
                            ?>
                        </td>
                        <td><?php echo number_format($row['costo_total'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No se encontraron lotes de producción.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="dashboard.php">← Volver al Dashboard</a>
    <a href="edit_lote.php?id=<?php echo $row['id']; ?>" class="btn">Editar</a>

</div>

</body>
</html>
