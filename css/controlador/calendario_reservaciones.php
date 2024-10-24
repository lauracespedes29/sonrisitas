<?php
session_start();
include_once '../modelo/conexion.php'; // Asegúrate de tener la conexión configurada

$conexion = new Conexion();

// Obtener todas las citas
$sql = "SELECT c.id_cita, c.fecha, c.hora, t.nombre AS tratamiento, p.nombres AS paciente
        FROM citas c
        JOIN tratamientos t ON c.tratamiento_id = t.id_tratamiento
        JOIN pacientes p ON c.paciente_id = p.id_paciente";
$stmt = $conexion->pdo->prepare($sql);
$stmt->execute();
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Formatear citas para FullCalendar
$eventos = [];
foreach ($citas as $cita) {
    $eventos[] = [
        'title' => $cita['tratamiento'] . ' - ' . $cita['paciente'],
        'start' => $cita['fecha'] . 'T' . $cita['hora'],
        'url' => '#'
    ];
}

echo json_encode($eventos);
