<?php
session_start();
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Obtener datos del artículo a eliminar
$nombre = $_GET['nombre'];
$categoria = $_GET['categoria'];
$fecha_vencimiento = $_GET['fecha_vencimiento'];
$marca = $_GET['marca'];

// Eliminar en la base de datos
try {
    $sql = "DELETE FROM farmacia WHERE nombre_medicamento = ? AND categoria = ? AND fecha_vencimiento = ? AND marca = ?";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->execute([$nombre, $categoria, $fecha_vencimiento, $marca]);
    echo "Artículo eliminado exitosamente.";
} catch
