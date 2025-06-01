<?php
$conexion = new mysqli("localhost", "root", "", "gestion_poda");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM solicitudes_poda ORDER BY fecha DESC";
$resultado = $conexion->query($sql);

$agrupado = [];

while ($row = $resultado->fetch_assoc()) {
    $dni = $row['dni'];
    if (!isset($agrupado[$dni])) {
        $agrupado[$dni] = [
            'nombre' => $row['nombre'],
            'solicitudes' => []
        ];
    }
    $agrupado[$dni]['solicitudes'][] = $row;
}

foreach ($agrupado as $dni => $datos) {
    $total = count($datos['solicitudes']);

    echo '<article class="solicitud-card prioridad-alta">
        <div class="solicitud-header">
            <span class="solicitud-id">Solicitante: ' . htmlspecialchars($datos['nombre']) . ' (DNI ' . htmlspecialchars($dni) . ')</span>
            <span class="solicitud-prioridad"><i class="fas fa-exclamation-triangle"></i> Múltiples solicitudes</span>
        </div>
        <div class="solicitud-body">
            <p class="solicitud-total">Total de solicitudes: ' . $total . '</p>
            <button class="btn-rechazar" onclick="rechazarTodas(\'' . $dni . '\')">
                <i class="fas fa-trash"></i> Rechazar todas
            </button>';

    foreach ($datos['solicitudes'] as $s) {
        echo '<div style="border-top:1px solid #ddd; padding-top:10px; margin-top:10px">
            <p><strong>#PODA-' . $s['id'] . '</strong></p>
            <p class="solicitud-direccion"><i class="fas fa-map-marker-alt"></i> ' . htmlspecialchars($s['direccion']) . '</p>
            <p><i class="fas fa-clock"></i> ' . $s['fecha'] . ' — <span class="estado-pendiente">Pendiente</span></p>
            <button 
                class="btn-detalle" 
                onclick="mostrarDetalleSolicitud(this)"
                data-id="' . $s['id'] . '"
                data-nombre="' . htmlspecialchars($s['nombre']) . '"
                data-dni="' . htmlspecialchars($s['dni']) . '"
                data-direccion="' . htmlspecialchars($s['direccion']) . '"
                data-coordenadas="' . htmlspecialchars($s['coordenadas']) . '"
                data-fecha="' . $s['fecha'] . '"
            >
                <i class="fas fa-search"></i> Ver detalles
            </button>
            <button class="btn-rechazar" style="margin-top: 5px;" onclick="rechazarIndividual(' . $s['id'] . ')">
                <i class="fas fa-trash-alt"></i> Rechazar esta
            </button>
        </div>';
    }

    echo '</div></article>';
}

$conexion->close();
?>
