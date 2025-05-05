<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>

  <?php
  session_start();
  if (!isset($_SESSION["username"])) {
      header("Location: index.html");
      exit();
  }
  ?>

  <aside>
    <div class="profile">
      <img src="./img/user.png" class="profile-img">
      <h2><?php echo $_SESSION["username"]; ?></h2>
    </div>

    <nav>
      <a href="dashboard.php">Dashboard</a>
      <a href="production.php">Production</a>
      <a href="ingredients.php">Ingredients</a>
      <a href="settings.php">Settings</a>
      <a class="logout" href="logout.php">Logout</a>
    </nav>
  </aside>

  <main>
    <div class="header">
      <h1>Dashboard</h1>
      <a href="new_lote.php" style="background-color: #c88f47; color: white; padding: 10px 20px; border: none; border-radius: 8px; text-decoration: none;">
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
          echo "<tr><td>{$row['id']}</td><td>{$fechaInicio} - {$fechaFin}</td><td><a href='#'>View</a></td></tr>";
        }?>
      </table>
    </div>

    <div class="section">
      <h3>Calculate Ingredients</h3>
      <form action="calculate.php" method="get">
        <input type="number" name="quantity" placeholder="Batch Quantity">
        <button>Calculate</button>
      </form>
    </div>

    <div class="section settings">
      <h3>Settings</h3>
      <label><input type="checkbox"> Username</label><br>
      <label><input type="checkbox"> Language</label><br>
      <label><input type="checkbox"> Units</label>
    </div>

    <div class="section">
      <h3>Requirideg ingredients</h3>
      <div class="ingredients">
        <div>🍺<br>Malt</div>
        <div>💧<br>Hops</div>
        <div>💦<br>Water</div>
      </div>
    </div>
  </main>

</body>
</html>
