<?php
include_once '../modelo/conexion.php';
$conexion = new Conexion();

// Obtener el tratamiento a editar por su ID
if (isset($_GET['id'])) {
    $id_tratamiento = $_GET['id'];
    
    $sql = "SELECT * FROM tratamientos WHERE id_tratamiento = ?";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->execute([$id_tratamiento]);
    $tratamiento = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tratamiento) {
        echo "Tratamiento no encontrado.";
        exit;
    }
}

// Manejo del formulario para actualizar tratamiento
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $doctor_id = $_POST['doctor_id'];
    $notas = $_POST['notas'];
    $costo = $_POST['costo'];
    $duracion = $_POST['duracion'];

    $sql = "UPDATE tratamientos SET nombre = ?, descripcion = ?, doctor_id = ?, notas = ?, costo = ?, duracion = ? WHERE id_tratamiento = ?";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->execute([$nombre, $descripcion, $doctor_id, $notas, $costo, $duracion, $id_tratamiento]);

    echo "Tratamiento actualizado exitosamente.";
}
?>

<!-- Formulario para editar tratamiento (similar al de agregar) -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tratamiento</title>
    <?php include_once 'layouts/header.php'; ?>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3>Editar Tratamiento</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre del Tratamiento</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($tratamiento['nombre']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($tratamiento['descripcion']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="doctor_id">Doctor Responsable</label>
                            <select class="form-control" id="doctor_id" name="doctor_id">
                                <?php
                                // Aquí llenamos el select con los doctores desde la base de datos
                                $sql = "SELECT id_doctor, nombres FROM doctores";
                                $stmt = $conexion->pdo->query($sql);
                                $doctores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($doctores as $doctor) {
                                    $selected = $doctor['id_doctor'] == $tratamiento['doctor_id'] ? 'selected' : '';
                                    echo "<option value='{$doctor['id_doctor']}' $selected>{$doctor['nombres']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notas">Notas Adicionales</label>
                            <textarea class="form-control" id="notas" name="notas"><?php echo htmlspecialchars($tratamiento['notas']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo ($)</label>
                            <input type="number" class="form-control" id="costo" name="costo" value="<?php echo htmlspecialchars($tratamiento['costo']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="duracion">Duración (minutos)</label>
                            <input type="number" class="form-control" id="duracion" name="duracion" value="<?php echo htmlspecialchars($tratamiento['duracion']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Tratamiento</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    
    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
