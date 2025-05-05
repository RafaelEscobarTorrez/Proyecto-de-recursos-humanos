<?php 
include("conexion.php");

$sql = "SELECT si.id, i.nombre_ingrediente, si.cantidad, si.fecha_ingreso 
        FROM stock_insumos si 
        INNER JOIN ingredientes i ON si.ingrediente_id = i.id";

$result = $conexion->query($sql);
?>

<link rel="stylesheet" href="./styles/production.css"> <!-- Usa un CSS adecuado -->

<div class="container">
    <h1>Stock de Insumos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ingrediente</th>
                <th>Cantidad</th>
                <th>Fecha de Ingreso</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_ingrediente']); ?></td>
                        <td><?php echo number_format($row['cantidad'], 2); ?></td>
                        <td><?php echo $row['fecha_ingreso']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay registros de stock disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
