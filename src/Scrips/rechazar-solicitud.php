<?php
$conexion = new mysqli("localhost", "root", "", "gestion_poda");
if ($conexion->connect_error) {
    die("Error: " . $conexion->connect_error);
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $conexion->query("DELETE FROM solicitudes_poda WHERE id = $id");
}

$conexion->close();
?>
