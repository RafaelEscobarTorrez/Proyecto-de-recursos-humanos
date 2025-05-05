<?php
include("conexion.php");

// Traer las recetas para el select
$sql_recetas = "SELECT id, nombre_receta FROM recetas";
$result_recetas = $conexion->query($sql_recetas);

?>

<link rel="stylesheet" href="./styles/new_lote.css">
<link rel="stylesheet" href="./styles/production.css">

<div class="container">
    <h1>Nuevo Lote de Producción</h1>

    <div id="fase1">
        <div id="datos1">
            <form id="form_receta">
                <h2>Calcular</h2>
                <label for="receta_id">Receta</label>
                <select name="receta_id" id="receta_id" required>
                    <option value="">Selecciona una receta</option>
                    <?php while($row = $result_recetas->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre_receta']); ?></option>
                    <?php endwhile; ?>
                </select>
                <br>
                <label for="litros_producidos">Cantidad</label>
                <input type="number" name="litros_producidos" id="litros_producidos" required>L
                <br>
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" required>
                <br>
                <a id="btn" href="javascript:verIngredientes()">Calcular</a>
            </form>
        </div>

        <div id="detalles1">
            <div id="calculos">
            </div>
        </div>
    </div>
</div>
