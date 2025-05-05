<?php
include("conexion.php");

$id_receta = $_GET['id_receta'];
$fecha_inicio = $_GET['fecha_inicio'];
$fecha_fin = $_GET['fecha_fin'];
$litros_producidos = $_GET['litros_producidos'];
$costo_total = $_GET['costo_total'];

$stmt=$conexion->prepare('INSERT INTO `lotes` (`receta_id`, `fecha_inicio`, `fecha_fin`, `litros_producidos`, `costo_total`) VALUES(?,?,?,?,?)');

$stmt->bind_param("issdd", $id_receta, $fecha_inicio, $fecha_fin, $litros_producidos, $costo_total);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Nuevo registro creado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$conexion->close();

echo "<meta http-equiv='refresh' content='0;url=main.php'>";
exit();
?>
