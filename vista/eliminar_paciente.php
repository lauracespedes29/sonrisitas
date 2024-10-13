<?php
// Iniciar sesión
session_start();
include_once '../modelo/conexion.php'; // Incluir la conexión a la base de datos
$conexion = new Conexion(); // Instancia de la conexión

// Verificar si se ha enviado el ID del paciente a eliminar
if (isset($_GET['id'])) {
    $id_paciente = $_GET['id'];

    // Eliminar el paciente de la base de datos
    $sql = "DELETE FROM pacientes WHERE id_paciente = :id_paciente";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "Paciente eliminado correctamente.";
        header("Location: mostrar_paciente.php"); // Redirigir a la página de pacientes
        exit;
    } else {
        echo "Error al eliminar el paciente.";
    }
} else {
    echo "ID de paciente no proporcionado.";
    exit;
}
?>
