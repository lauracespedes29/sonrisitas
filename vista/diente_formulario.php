<?php
// Conexión a la base de datos
include_once '../modelo/conexion.php'; 
$conexion = new Conexion(); 

$paciente_id = isset($_GET['paciente_id']) ? $_GET['paciente_id'] : '';
$diente = isset($_GET['diente']) ? $_GET['diente'] : '';

// Obtener los datos actuales del diente
$sqlDiente = "SELECT * FROM odontograma WHERE paciente_id = :paciente_id AND diente = :diente";
$stmtDiente = $conexion->pdo->prepare($sqlDiente);
$stmtDiente->bindValue(':paciente_id', $paciente_id);
$stmtDiente->bindValue(':diente', $diente);
$stmtDiente->execute();
$dienteDatos = $stmtDiente->fetch(PDO::FETCH_ASSOC);

// Obtener la lista de tratamientos disponibles
$sqlTratamientos = "SELECT * FROM tratamientos";
$stmtTratamientos = $conexion->pdo->query($sqlTratamientos);
$tratamientos = $stmtTratamientos->fetchAll(PDO::FETCH_ASSOC);

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'];
    $estado_diente = $_POST['estado'];
    $tratamiento_id = $_POST['tratamiento'];

    // Registrar los datos del diente en la base de datos
    $sql = "INSERT INTO odontograma (paciente_id, diente, descripcion, estado, tratamiento_id) 
            VALUES (:paciente_id, :diente, :descripcion, :estado, :tratamiento_id)
            ON DUPLICATE KEY UPDATE descripcion = :descripcion, estado = :estado, tratamiento_id = :tratamiento_id";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindValue(':paciente_id', $paciente_id);
    $stmt->bindValue(':diente', $diente);
    $stmt->bindValue(':descripcion', $descripcion);
    $stmt->bindValue(':estado', $estado_diente);
    $stmt->bindValue(':tratamiento_id', $tratamiento_id);

    if ($stmt->execute()) {
        echo "<script>alert('Datos del diente registrados con éxito.'); window.location.href='odontograma.php?paciente_id=$paciente_id';</script>";
    } else {
        echo "<script>alert('Error al registrar los datos del diente.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Diente <?= $diente ?></title>
    <?php include_once 'layouts/header.php'; ?>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Datos del Diente <?= $diente ?> de Paciente ID: <?= $paciente_id ?></h1>
        </section>

        <section class="content">
            <form method="POST">
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" required><?= isset($dienteDatos['descripcion']) ? htmlspecialchars($dienteDatos['descripcion']) : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label>Estado del Diente</label>
                    <select name="estado" class="form-control" required>
                        <option value="sano" <?= isset($dienteDatos['estado']) && $dienteDatos['estado'] == 'sano' ? 'selected' : '' ?>>Sano</option>
                        <option value="caries" <?= isset($dienteDatos['estado']) && $dienteDatos['estado'] == 'caries' ? 'selected' : '' ?>>Caries</option>
                        <option value="tratado" <?= isset($dienteDatos['estado']) && $dienteDatos['estado'] == 'tratado' ? 'selected' : '' ?>>Tratado</option>
                        <option value="extracción" <?= isset($dienteDatos['estado']) && $dienteDatos['estado'] == 'extracción' ? 'selected' : '' ?>>Extracción</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tratamiento</label>
                    <select name="tratamiento" class="form-control" required>
                        <option value="">Seleccionar tratamiento</option>
                        <?php foreach ($tratamientos as $tratamiento): ?>
                            <option value="<?= $tratamiento['id_tratamiento'] ?>" <?= isset($dienteDatos['tratamiento_id']) && $dienteDatos['tratamiento_id'] == $tratamiento['id_tratamiento'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($tratamiento['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </section>
    </div>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
