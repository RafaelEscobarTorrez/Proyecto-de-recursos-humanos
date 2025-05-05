<?php
session_start();
include("conexion.php"); // Aquí se define $conexion

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);

    // Cambiar $conn por $conexion
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $_SESSION["username"] = $username;
            header("Location: main.php");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
}
?>
