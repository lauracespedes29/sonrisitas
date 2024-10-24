<?php
session_start();
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Verificar si se ha enviado el ID de la cita a eliminar
if (isset($_GET['id'])) {
    $id_cita = $_GET['id'];

    // Eliminar la cita de la base de datos
    $sql = "DELETE FROM citas WHERE id_cita = :id_cita";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        // Mensaje de éxito
        $_SESSION['message'] = "Cita eliminada correctamente.";
    } else {
        $_SESSION['message'] = "Error al eliminar la cita.";
    }
} else {
    $_SESSION['message'] = "ID de cita no proporcionado.";
}

// Redirigir a la página de reservas con el estado adecuado
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';
header("Location: mostrar_reservas.php?estado=" . urlencode($estado)); // Redirigir a la página de reservas
exit;
