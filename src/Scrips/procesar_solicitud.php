<?php
$conexion = new mysqli("localhost", "root", "", "gestion_poda");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$coordenadas = $_POST['coordenadas'];
$motivo = $_POST['motivo'];
$descripcion = $_POST['descripcion'];
$residente = isset($_POST['confirmacion']) ? 1 : 0;

$sql = "INSERT INTO solicitudes_poda (nombre, dni, direccion, coordenadas, motivo, descripcion, residente)
        VALUES ('$nombre', '$dni', '$direccion', '$coordenadas', '$motivo', '$descripcion', $residente)";

if ($conexion->query($sql) === TRUE) {
    echo "Solicitud enviada correctamente";
} else {
    echo "Error: " . $conexion->error;
}

$conexion->close();
?>
