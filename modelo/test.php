<?php
require 'conexion.php'; // Asegúrate de que el archivo de conexión esté en la misma carpeta

$conexion = new Conexion(); // Crear una instancia de la clase

if ($conexion->pdo) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error de conexión.";
}
?>
