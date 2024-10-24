<?php
include_once '../modelo/conexion.php';
$conexion = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tratamiento = $_POST['id'];

    // Elimina el tratamiento
    $sql = "DELETE FROM tratamientos WHERE id_tratamiento = ?";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->execute([$id_tratamiento]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar el tratamiento.']);
    }
}
?>
