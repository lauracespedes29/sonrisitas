<?php
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Inicializar variables
$paciente_id = isset($_GET['paciente_id']) ? $_GET['paciente_id'] : '';
$fecha = '';
$hora = '';
$notas = '';
$id_tratamiento = '';
$estado = 'pendiente'; // Establecer estado por defecto
$citasHoy = []; // Para almacenar las citas del día

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $notas = $_POST['notas'];
    $id_tratamiento = $_POST['id_tratamiento'];
    $estado = $_POST['estado']; // Obtener el estado del formulario

    // Registrar la cita en la base de datos
    $sql = "INSERT INTO citas (paciente_id, fecha, hora, notas, id_tratamiento, estado) VALUES (:paciente_id, :fecha, :hora, :notas, :id_tratamiento, :estado)";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindValue(':paciente_id', $paciente_id);
    $stmt->bindValue(':fecha', $fecha);
    $stmt->bindValue(':hora', $hora);
    $stmt->bindValue(':notas', $notas);
    $stmt->bindValue(':id_tratamiento', $id_tratamiento);
    $stmt->bindValue(':estado', $estado); // Vincular el estado
    
    if ($stmt->execute()) {
        // Verificar si la cita es para hoy
        if ($fecha == date('Y-m-d')) {
            // Obtener las citas para hoy
            $sqlHoy = "SELECT * FROM citas WHERE fecha = :fecha";
            $stmtHoy = $conexion->pdo->prepare($sqlHoy);
            $stmtHoy->bindValue(':fecha', $fecha);
            $stmtHoy->execute();
            $citasHoy = $stmtHoy->fetchAll(PDO::FETCH_ASSOC);
        }

        // Mostrar mensaje de éxito y redirigir
        echo "<script>
                alert('Cita registrada con éxito.');
                window.location.href = 'calendario.php';
              </script>";
        exit; // Asegúrate de detener la ejecución del script aquí
    } else {
        echo "<script>alert('Error al registrar la cita.');</script>";
    }
}

// Obtener información del paciente
$paciente = [];
if ($paciente_id) {
    $sql = "SELECT * FROM pacientes WHERE id_paciente = :paciente_id";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindValue(':paciente_id', $paciente_id);
    $stmt->execute();
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Registrar Cita</title>
    <?php include_once 'layouts/header.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Registrar Cita para <?= htmlspecialchars($paciente['nombres']); ?></h1>
        </section>
        
        <section class="content">
            <form method="POST" action="">
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Hora</label>
                    <input type="time" name="hora" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Notas</label>
                    <textarea name="notas" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Tratamiento</label>
                    <select name="id_tratamiento" class="form-control" required>
                        <option value="">Seleccione un Tratamiento</option>
                        <?php foreach ($tratamientos as $tratamiento): ?>
                            <option value="<?= $tratamiento['id_tratamiento']; ?>"><?= htmlspecialchars($tratamiento['nombre']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="pendiente">Pendiente</option>
                        <option value="cobrado">Cobrado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Registrar Cita</button>
            </form>
        </section>
    </div>

    <?php if (!empty($citasHoy)): ?>
    <script>
        $(document).ready(function() {
            var citas = <?= json_encode($citasHoy); ?>;
            var mensaje = "Citas programadas para hoy:\n";
            citas.forEach(function(cita) {
                mensaje += "Paciente ID: " + cita.paciente_id + "\n";
                mensaje += "Hora: " + cita.hora + "\n";
                mensaje += "Notas: " + cita.notas + "\n\n";
            });
            alert(mensaje); // Mostrar la alerta con las citas
        });
    </script>
    <?php endif; ?>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
