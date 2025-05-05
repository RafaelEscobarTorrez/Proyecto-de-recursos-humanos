<?php
$conexion = new mysqli("localhost", "root", "", "db_recursos");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
