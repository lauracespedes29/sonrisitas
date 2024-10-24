<?php
session_start();
include_once '../modelo/conexion.php'; // Verifica que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Verificar si se proporcionó el número de documento a través de la URL
if (isset($_GET['documento'])) {
    $numero_documento = $_GET['documento'];

    // Obtener la información del paciente basado en el número de documento
    try {
        $sql = "SELECT * FROM pacientes WHERE numero_documento = ?";
        $stmt = $conexion->pdo->prepare($sql);
        $stmt->execute([$numero_documento]);
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$paciente) {
            echo "Paciente no encontrado.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error al obtener el paciente: " . $e->getMessage();
        exit;
    }

    // Obtener el historial odontológico del paciente
    try {
        $sql = "SELECT h.*, t.nombre AS tratamiento_nombre FROM historialodontologico h 
                JOIN tratamientos t ON h.tratamiento_id = t.id_tratamiento 
                WHERE h.paciente_id = ?";
        $stmt = $conexion->pdo->prepare($sql);
        $stmt->execute([$paciente['id_paciente']]);
        $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener el historial: " . $e->getMessage();
        exit;
    }
} else {
    echo "No se proporcionó un número de documento.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Odontología - Historial del Paciente</title>
    <?php include_once 'layouts/header.php'; ?>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <!-- Encabezado -->
        <section class="content-header">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="card-header text-center p-4" style="background-color: #007bff; color: white;">
                        <h1 class="card-title">
                            <i class="fas fa-history"></i> Historial de <?php echo htmlspecialchars($paciente['nombres'] . " " . $paciente['apellido_paterno']); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Información del Paciente -->
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><b>Información del Paciente</b></h3>
                </div>
                <div class="card-body">
                    <p><strong>Nombres:</strong> <?php echo htmlspecialchars($paciente['nombres']); ?></p>
                    <p><strong>Apellido Paterno:</strong> <?php echo htmlspecialchars($paciente['apellido_paterno']); ?></p>
                    <p><strong>Apellido Materno:</strong> <?php echo htmlspecialchars($paciente['apellido_materno']); ?></p>
                    <p><strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?></p>
                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($paciente['direccion']); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($paciente['telefono']); ?></p>
                    <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($paciente['email']); ?></p>
                    <p><strong>Número de Documento:</strong> <?php echo htmlspecialchars($paciente['numero_documento']); ?></p>
                </div>
            </div>
        </section>

        <!-- Historial Odontológico -->
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><b>Historial Odontológico</b></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tratamiento</th>
                                    <th>Fecha</th>
                                    <th>Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($historial)): ?>
                                    <?php foreach ($historial as $entry): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($entry['tratamiento_nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($entry['fecha']); ?></td>
                                            <td><?php echo htmlspecialchars($entry['notas']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No hay historial registrado para este paciente.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
