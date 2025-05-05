<?php
include("conexion.php");

$sql = "SELECT lotes.id, recetas.nombre_receta, lotes.fecha_inicio, lotes.fecha_fin, lotes.litros_producidos, lotes.costo_total 
        FROM lotes 
        INNER JOIN recetas ON lotes.receta_id = recetas.id";

$result = $conexion->query($sql);
$fecha_actual = date("Y-m-d");
?>

<link rel="stylesheet" href="./styles/production.css">

<div class="container">
    <h1>Lotes de Producción</h1>

    <a href="javascript:verProduction('new_lote.php')" class="btn">Nuevo Lote</a>

    <table>
        <thead>
            <tr>
                <th>Lote</th>
                <th>Receta</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Volumen</th>
                <th>Estado</th>
                <th>Costo Total (Bs)</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <?php
                        //Definir el estado del lote
                          $estado = "";
                          if ($fecha_actual < $row['fecha_inicio']) {
                              $estado = "Planificado";
                          } elseif ($fecha_actual >= $row['fecha_inicio'] && $fecha_actual <= $row['fecha_fin']) {
                              $estado = "En proceso";
                          } else {
                              $estado = "Terminado";
                          }
                    ?>
                    
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nombre_receta']); ?></td>
                        <td><?php echo $row['fecha_inicio']; ?></td>
                        <td><?php echo $row['fecha_fin']; ?></td>
                        <td><?php echo $row['litros_producidos']; ?> L</td>
                        <?php
                           if ($estado == 'En proceso') {
                               echo '<td><span class="estado-en-proceso">En Proceso</span></td>';
                           } elseif ($estado == 'Terminado') {
                               echo '<td><span class="estado-terminado">Terminado</span></td>';
                           } elseif ($estado == 'Planificado') {
                               echo '<td><span class="estado-planificado">Planificado</span></td>';
                           } else {
                               echo '<td>' . htmlspecialchars($row['estado']) . '</td>';
                           }
                        ?>
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
</div>
