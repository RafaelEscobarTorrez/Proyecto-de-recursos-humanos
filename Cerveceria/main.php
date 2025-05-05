<?php
  session_start();
  if (!isset($_SESSION["username"])) {
      header("Location: index.html");
      exit();
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido - <?php echo $_SESSION["username"]; ?> </title>
  <link rel="stylesheet" href="./styles/styles.css">
  <script src="./public/ajax.js"></script>
</head>
<body>

  <aside>
    <div class="profile">
      <img src="./img/user.png" class="profile-img">
      <h2><?php echo $_SESSION["username"]; ?></h2>
    </div>

    <nav>
      <a href="main.php">Dashboard</a>
      <a href="javascript:verProduction('production.php')">Production</a>
      <a href="javascript:verProduction('ingredients.php')">Ingredients</a>
      <a href="javascript:verProduction('inventory.php')">Inventory</a>
      <a class="logout" href="logout.php">Logout</a>
    </nav>
    
  </aside>

  <div id="content">
  <div class="header">
      <h1>Dashboard</h1>
      <a href="javascript:verProduction('new_lote.php')" style="background-color: #c88f47; color: white; padding: 10px 20px; border: none; border-radius: 8px; text-decoration: none;">
        New Process
      </a>
    </div>

    <div class="section production-list">
      <?php
      include("conexion.php");
      $sqlLotes = "SELECT id, fecha_inicio, fecha_fin FROM lotes ORDER BY fecha_inicio DESC LIMIT 3;";
      $resultadoLotes = $conexion->query($sqlLotes);
      ?>

      <h3>Production List</h3>

      <table>
        <tr><th>Batch</th><th>Date</th><th>Details</th></tr>
        <?php
        while($row=mysqli_fetch_array($resultadoLotes)){
          $fechaInicio = date("d/m/Y", strtotime($row['fecha_inicio']));
          $fechaFin = date("d/m/Y", strtotime($row['fecha_fin']));
          echo "<tr><td>{$row['id']}</td><td>{$fechaInicio} - {$fechaFin}</td><td><a href='javascript:verProduction(`production.php`)'>View</a></td></tr>";
        }?>
      </table>
    </div>

    <div class="section">
      <?php
        $sql_recetas = "SELECT id, nombre_receta FROM recetas";
        $result_recetas = $conexion->query($sql_recetas);      
      ?>
      <h3>Calculate Ingredients</h3>
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
      <a id="btn" href="javascript:verIngredientesAD()">Calcular</a>
    </div>
  </div>

</body>
</html>
