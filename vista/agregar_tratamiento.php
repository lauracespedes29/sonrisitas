<?php
include_once '../modelo/conexion.php';
$conexion = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $doctor_id = $_POST['doctor_id'];
    $notas = $_POST['notas'];
    $costo = $_POST['costo'];
    $duracion = $_POST['duracion'];

    // Verifica si el tratamiento ya existe
    $query = "SELECT * FROM tratamientos WHERE nombre = ?";
    $stmt = $conexion->pdo->prepare($query);
    $stmt->execute([$nombre]);
    $tratamientoExistente = $stmt->fetch();

    if ($tratamientoExistente) {
        echo json_encode(['status' => 'error', 'message' => 'El tratamiento ya existe.']);
    } else {
        // Inserta el nuevo tratamiento
        $sql = "INSERT INTO tratamientos (nombre, descripcion, doctor_id, notas, costo, duracion) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $doctor_id, $notas, $costo, $duracion]);

        // Recupera el ID del nuevo tratamiento
        $nuevo_id = $conexion->pdo->lastInsertId();

        // Devuelve el nuevo tratamiento en formato HTML
        $nuevoTratamientoHTML = '<li class="list-group-item" id="tratamiento-' . $nuevo_id . '">
                                    <strong>' . htmlspecialchars($nombre) . '</strong> - ' . htmlspecialchars($descripcion) . '
                                    <span class="badge badge-primary float-right">Costo: $' . htmlspecialchars($costo) . '</span>
                                    <div class="float-right mr-2">
                                        <a href="editar_tratamiento.php?id=' . $nuevo_id . '" class="btn btn-warning btn-sm">Editar</a>
                                        <button class="btn btn-danger btn-sm" onclick="eliminarTratamiento(' . $nuevo_id . ')">Eliminar</button>
                                    </div>
                                  </li>';

        echo json_encode(['status' => 'success', 'nuevoTratamientoHTML' => $nuevoTratamientoHTML]);
    }
}
?>
