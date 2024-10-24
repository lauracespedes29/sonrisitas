<?php
session_start(); // Asegúrate de que la sesión esté iniciada
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion();

// Obtener la lista de tratamientos existentes
$query = "SELECT * FROM tratamientos";
$stmt = $conexion->pdo->query($query);
$tratamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Manejo del formulario para agregar tratamiento
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    if ($_POST['accion'] == 'agregar') {
        // Recoge los datos del formulario
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $doctor_id = !empty($_POST['doctor_id']) ? $_POST['doctor_id'] : null; // Permitir null
        $notas = trim($_POST['notas']);
        $costo = $_POST['costo'];
        $duracion = $_POST['duracion'];

        // Verifica si el tratamiento ya existe
        $query = "SELECT * FROM tratamientos WHERE nombre = ?";
        $stmt = $conexion->pdo->prepare($query);
        $stmt->execute([$nombre]);
        $tratamientoExistente = $stmt->fetch();

        if ($tratamientoExistente) {
            echo json_encode(['status' => 'error', 'message' => 'El tratamiento ya existe.']);
        } else {
            // Inserta el nuevo tratamiento
            try {
                $sql = "INSERT INTO tratamientos (nombre, descripcion, doctor_id, notas, costo, duracion) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conexion->pdo->prepare($sql);
                $stmt->execute([$nombre, $descripcion, $doctor_id, $notas, $costo, $duracion]);

                // Recupera el ID del nuevo tratamiento
                $nuevo_id = $conexion->pdo->lastInsertId();

                // Devuelve el nuevo tratamiento en formato HTML
                $nuevoTratamientoHTML = '<li class="list-group-item" id="tratamiento-' . $nuevo_id . '">
                                            <strong>' . htmlspecialchars($nombre) . '</strong> - ' . htmlspecialchars($descripcion) . '
                                            <span class="badge badge-primary float-right">Costo: $' . htmlspecialchars($costo) . '</span>
                                            <div class="float-right mr-2">
                                                <a href="editar_tratamiento.php?id=' . $nuevo_id . '" class="btn btn-warning btn-sm">Editar</a>
                                                <button class="btn btn-danger btn-sm" onclick="eliminarTratamiento(' . $nuevo_id . ')">Eliminar</button>
                                            </div>
                                          </li>';

                echo json_encode(['status' => 'success', 'nuevoTratamientoHTML' => $nuevoTratamientoHTML]);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error al agregar el tratamiento: ' . $e->getMessage()]);
            }
        }
        exit; // Terminar la ejecución aquí
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tratamientos</title>
    <?php include_once 'layouts/header.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="card-header text-center p-4" style="background-color: #007bff; color: white; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
                        <h1 class="card-title" style="font-size: 2.5rem; font-weight: bold;">
                            <i class="fas fa-file-medical"></i> Gestión de Tratamientos
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Lista de Tratamientos Existentes -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <h3>Tratamientos Disponibles</h3>
                    <ul class="list-group" id="listaTratamientos">
                        <?php foreach ($tratamientos as $tratamiento): ?>
                            <li class="list-group-item" id="tratamiento-<?php echo $tratamiento['id_tratamiento']; ?>">
                                <strong><?php echo htmlspecialchars($tratamiento['nombre']); ?></strong> - <?php echo htmlspecialchars($tratamiento['descripcion']); ?>
                                <span class="badge badge-primary float-right">Costo: $<?php echo htmlspecialchars($tratamiento['costo']); ?></span>
                                <div class="float-right mr-2">
                                    <a href="editar_tratamiento.php?id=<?php echo $tratamiento['id_tratamiento']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <button class="btn btn-danger btn-sm" onclick="eliminarTratamiento(<?php echo $tratamiento['id_tratamiento']; ?>)">Eliminar</button>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Formulario para Agregar Tratamiento -->
                <div class="col-md-6">
                    <h3>Agregar Nuevo Tratamiento</h3>
                    <form id="formAgregarTratamiento">
                        <input type="hidden" name="accion" value="agregar">
                        <div class="form-group">
                            <label for="nombre">Nombre del Tratamiento</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="doctor_id">Doctor Responsable (Opcional)</label>
                            <select class="form-control" id="doctor_id" name="doctor_id">
                                <option value="">Seleccione un Doctor</option>
                                <?php
                                $query = "SELECT id_doctor, nombres FROM doctores";
                                $stmt = $conexion->pdo->query($query);
                                $doctores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($doctores as $doctor) {
                                    echo "<option value='{$doctor['id_doctor']}'>{$doctor['nombres']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notas">Notas Adicionales</label>
                            <textarea class="form-control" id="notas" name="notas"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo (Bs)</label>
                            <input type="number" step="0.01" class="form-control" id="costo" name="costo" required>
                        </div>
                        <div class="form-group">
                            <label for="duracion">Duración (minutos)</label>
                            <input type="number" class="form-control" id="duracion" name="duracion" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Tratamiento</button>
                    </form>
                    <div id="mensaje" style="margin-top: 10px;"></div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Manejar el envío del formulario para agregar un tratamiento
        $(document).ready(function() {
            $('#formAgregarTratamiento').submit(function(event) {
                event.preventDefault(); // Prevenir el envío del formulario por defecto

                $.ajax({
                    type: 'POST',
                    url: 'tratamientos.php', // Aquí la misma página para manejar la solicitud
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#listaTratamientos').append(response.nuevoTratamientoHTML);
                            $('#mensaje').html('<div class="alert alert-success">Tratamiento agregado exitosamente.</div>');
                            $('#formAgregarTratamiento')[0].reset(); // Limpiar el formulario
                        } else {
                            $('#mensaje').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $('#mensaje').html('<div class="alert alert-danger">Error al agregar el tratamiento. Por favor, inténtelo de nuevo.</div>');
                    }
                });
            });
        });

        // Función para eliminar un tratamiento
        function eliminarTratamiento(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este tratamiento?')) {
                $.ajax({
                    type: 'POST',
                    url: 'eliminar_tratamiento.php', // Asegúrate de tener este archivo
                    data: { id: id },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#tratamiento-' + id).remove(); // Elimina el tratamiento de la lista
                            $('#mensaje').html('<div class="alert alert-success">Tratamiento eliminado exitosamente.</div>');
                        } else {
                            $('#mensaje').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $('#mensaje').html('<div class="alert alert-danger">Error al eliminar el tratamiento. Por favor, inténtelo de nuevo.</div>');
                    }
                });
            }
        }
    </script>
</body>
</html>
