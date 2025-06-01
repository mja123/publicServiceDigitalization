<?php
$conexion = new mysqli("localhost", "root", "", "gestion_poda");
if ($conexion->connect_error) {
    die("Error: " . $conexion->connect_error);
}

if (isset($_POST['dni'])) {
    $dni = $conexion->real_escape_string($_POST['dni']);
    $conexion->query("DELETE FROM solicitudes_poda WHERE dni = '$dni'");
}

$conexion->close();
?>
