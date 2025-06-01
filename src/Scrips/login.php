<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "gestion_poda");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Validar contraseña (si estuviera hasheada usar password_verify)
    if ($password === $usuario['password']) {
        $_SESSION['usuario'] = $usuario['email'];
        header("Location: ../html/panel-operador.html");
        exit;
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}

$stmt->close();
$conexion->close();
?>
