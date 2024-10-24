<?php
session_start();
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

$message = ""; // Variable para almacenar mensajes

// Inicializar variables
$id_cita = '';
$fecha = '';
$hora = '';
$notas = '';
$paciente_id = '';
$id_tratamiento = '';
$estado = ''; // Agregar variable para estado

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $id_cita = $_POST['id_cita'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $notas = $_POST['notas'];
    $paciente_id = $_POST['paciente_id']; // Asume que tienes el ID del paciente en el formulario
    $id_tratamiento = $_POST['id_tratamiento']; // Asume que tienes el ID del tratamiento
    $estado = $_POST['estado']; // Obtener estado desde el formulario

    // Actualizar en la base de datos
    try {
        $sql = "UPDATE citas SET 
                    fecha = ?, 
                    hora = ?, 
                    notas = ?, 
                    paciente_id = ?, 
                    id_tratamiento = ?, 
                    estado = ? 
                WHERE id_cita = ?";
        $stmt = $conexion->pdo->prepare($sql);
        $stmt->execute([$fecha, $hora, $notas, $paciente_id, $id_tratamiento, $estado, $id_cita]);
        $message = "Reservación actualizada exitosamente."; // Mensaje de éxito
    } catch (PDOException $e) {
        $message = "Error al actualizar reservación: " . $e->getMessage(); // Mensaje de error
    }
}

// Cargar datos de la cita a editar
if (isset($_GET['id'])) {
    $id_cita = $_GET['id'];
    $sql = "SELECT * FROM citas WHERE id_cita = :id_cita";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindValue(':id_cita', $id_cita, PDO::PARAM_INT);
    $stmt->execute();
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cita) {
        echo "Reservación no encontrada.";
        exit;
    }

    // Obtener ID del paciente y tratamiento para el formulario
    $paciente_id = $cita['paciente_id'];
    $id_tratamiento = $cita['id_tratamiento'];
    $estado = $cita['estado']; // Obtener estado
} else {
    echo "ID de reservación no especificado.";
    exit;
}

// Obtener lista de tratamientos
$queryTratamientos = "SELECT * FROM tratamientos";
$stmtTratamientos = $conexion->pdo->query($queryTratamientos);
$tratamientos = $stmtTratamientos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reservación</title>
    <?php include_once 'layouts/header.php'; ?>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Editar Reservación</h1>
        </section>

        <section class="content">
            <?php if ($message): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <form action="" method="post"> <!-- Aquí se envía el formulario a sí mismo -->
                <input type="hidden" name="id_cita" value="<?= htmlspecialchars($cita['id_cita']); ?>">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?= htmlspecialchars($cita['fecha']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="hora">Hora</label>
                    <input type="time" class="form-control" id="hora" name="hora" value="<?= htmlspecialchars($cita['hora']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="notas">Notas</label>
                    <textarea class="form-control" id="notas" name="notas" required><?= htmlspecialchars($cita['notas']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="paciente_id">Paciente ID</label>
                    <input type="text" class="form-control" id="paciente_id" name="paciente_id" value="<?= htmlspecialchars($cita['paciente_id']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="id_tratamiento">Tratamiento</label>
                    <select name="id_tratamiento" class="form-control" required>
                        <option value="">Seleccione un Tratamiento</option>
                        <?php foreach ($tratamientos as $tratamiento): ?>
                            <option value="<?= $tratamiento['id_tratamiento']; ?>" <?= $tratamiento['id_tratamiento'] == $id_tratamiento ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($tratamiento['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="pendiente" <?= $estado == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                        <option value="cobrado" <?= $estado == 'cobrado' ? 'selected' : ''; ?>>Cobrado</option>
                        <option value="cancelado" <?= $estado == 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Reservación</button>
            </form>
        </section>
    </div>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
