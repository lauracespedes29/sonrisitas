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

    // Manejo del formulario para agregar historial
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $tratamiento_id = $_POST['tratamiento'];
        $fecha = $_POST['fecha'];
        $notas = $_POST['notas'];

        // Insertar el historial odontológico en la base de datos
        try {
            $sql = "INSERT INTO historialodontologico (paciente_id, tratamiento_id, fecha, notas) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $conexion->pdo->prepare($sql);
            $stmt->execute([$paciente['id_paciente'], $tratamiento_id, $fecha, $notas]);
            echo "Historial agregado exitosamente.";
        } catch (PDOException $e) {
            echo "Error al agregar historial: " . $e->getMessage();
        }
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
    <title>Sistema Odontología - Agregar Historial</title>
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
                            <i class="fas fa-notes-medical"></i> Agregar Historial para <?php echo htmlspecialchars($paciente['nombres'] . " " . $paciente['apellido_paterno']); ?>
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

        <!-- Formulario para agregar historial -->
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h2><b>Formulario de Historial Odontológico</b></h2>
                </div>
                <div class="card-body">
                    <form action="" method="post"> <!-- Aquí se envía el formulario a sí mismo -->
                        <div class="form-group">
                            <label for="tratamiento">Tratamiento</label>
                            <select class="form-control" id="tratamiento" name="tratamiento" required>
                                <option value="" disabled selected>Seleccione un tratamiento</option>
                                <?php
                                // Aquí se obtienen los tratamientos disponibles de la base de datos
                                $sql = "SELECT id_tratamiento, nombre FROM tratamientos";
                                $stmt = $conexion->pdo->query($sql);
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id_tratamiento'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha del Tratamiento</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>

                        <div class="form-group">
                            <label for="notas">Notas Adicionales</label>
                            <textarea class="form-control" id="notas" name="notas" rows="4" placeholder="Ingrese notas del tratamiento"></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Agregar Historial</button>
                            <a href="ver_paciente.php?documento=<?php echo $numero_documento; ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
