<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    exit();
}

include("conexion.php");

if (!isset($_GET['id_receta']) || !isset($_GET['quantity']) || !isset($_GET['fecha_inicio'])) {
    echo "Faltan parámetros.";
    exit();
}

$id_receta = intval($_GET['id_receta']);
$quantity = floatval($_GET['quantity']);
$fecha_inicio = $_GET['fecha_inicio']; // formato: YYYY-MM-DD

// Validar fecha
if (!strtotime($fecha_inicio)) {
    echo "Fecha de inicio no válida.";
    exit();
}

// Consulta extendida
$sql = "SELECT 
            r.litros_base, 
            r.tiempo_fermentacion,
            i.nombre_ingrediente, 
            i.unidad, 
            ir.cantidad, 
            i.precio_unitario
        FROM recetas r
        JOIN ingredientes_receta ir ON r.id = ir.receta_id
        JOIN ingredientes i ON ir.ingrediente_id = i.id 
        WHERE r.id = $id_receta";

$resultado = $conexion->query($sql);

if (!$resultado || $resultado->num_rows === 0) {
    echo "No se encontraron ingredientes para esta receta.";
    exit();
}

// Obtener litros_base y tiempo_fermentacion desde la primera fila
$row = $resultado->fetch_assoc();
$litros_base = floatval($row['litros_base']);
$tiempo_fermentacion = intval($row['tiempo_fermentacion']); // en días

// Calcular fecha de finalización
$fecha_finalizacion = date('Y-m-d', strtotime($fecha_inicio . " +{$tiempo_fermentacion} days"));

// Volver a empezar el resultado
$resultado->data_seek(0);

$ingredientes = [];
$costo_total = 0;

while ($row = $resultado->fetch_assoc()) {
    $cantidad_base = floatval($row['cantidad']);
    $cantidad_necesaria = ($cantidad_base / $litros_base) * $quantity;
    $precio_unitario = floatval($row['precio_unitario']);
    $costo = $cantidad_necesaria * $precio_unitario;
    $costo_total += $costo;

    $ingredientes[] = [
        'nombre' => $row['nombre_ingrediente'],
        'cantidad' => round($cantidad_necesaria, 2),
        'unidad' => $row['unidad'],
        'precio_unitario' => round($precio_unitario, 2),
        'costo' => round($costo, 2)
    ];
}

// Mostrar resultados
echo "<h2>Ingredientes necesarios para {$quantity} L</h2>";
echo "<p><strong>Fecha de inicio:</strong> {$fecha_inicio}</p>";
echo "<p><strong>Tiempo de fermentación:</strong> {$tiempo_fermentacion} días</p>";
echo "<p><strong>Fecha de finalización estimada:</strong> <span style='color: blue;'>{$fecha_finalizacion}</span></p>";

echo "<table border='1' style='border-collapse: collapse; margin-top: 10px;'>";
echo "<thead>
        <tr>
            <th>Ingrediente</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Precio Unitario</th>
            <th>Costo</th>
        </tr>
      </thead>
      <tbody>";

foreach ($ingredientes as $ing) {
    echo "<tr>
            <td>{$ing['nombre']}</td>
            <td>{$ing['cantidad']}</td>
            <td>{$ing['unidad']}</td>
            <td>\${$ing['precio_unitario']}</td>
            <td>\${$ing['costo']}</td>
          </tr>";
}

echo "</tbody></table>";

echo "<h3 style='margin-top: 10px;'>Costo total de ingredientes: <span style='color: green;'>\$" . round($costo_total, 2) . "</span></h3>";

// Enlaces
echo "<a id='btn' href='addproduction.php?id_receta=$id_receta&fecha_inicio=$fecha_inicio&fecha_fin=$fecha_finalizacion&litros_producidos=$quantity&costo_total=$costo_total'>Add Production</a>";
echo "<br>"
?>
