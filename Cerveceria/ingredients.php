<?php
include("conexion.php");

// Traer todos los ingredientes
$sql = "SELECT * FROM ingredientes";
$result = $conexion->query($sql);
?>
<link rel="stylesheet" href="./styles/ingredientes.css">
<div class="container">
    <h1>Ingredientes</h1>

    <a href="javascript:verProduction('new_ingredient.php')" class="btn">Agregar Ingrediente</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Unidad de Medida</th>
                <th>Costo Unitario (Bs)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_ingrediente']); ?></td>
                    <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                    <td><?php echo htmlspecialchars($row['unidad']); ?></td>
                    <td><?php echo number_format($row['precio_unitario'], 2); ?></td>
                    <td>
                        <a href="javascript:formEditar(<?php echo $row['id']; ?>)" class="btn">Editar</a>
                        <a href="javascript:eliminar(<?php echo $row['id']; ?>)" class="btn">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
