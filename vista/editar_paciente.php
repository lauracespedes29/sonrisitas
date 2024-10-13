<?php
session_start();
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombres = $_POST['firstName'];
    $apellido_paterno = $_POST['lastNameP'];
    $apellido_materno = $_POST['lastNameM'];
    $fecha_nacimiento = $_POST['dob'];
    $direccion = $_POST['address'];
    $telefono = $_POST['phone'];
    $email = $_POST['email'];
    $nombre_contacto_emergencia = $_POST['emergencyContact'];
    $genero = $_POST['gender'];
    $tipo_documento = $_POST['documentType'];
    $numero_documento = $_POST['documentNumber'];

    // Actualizar en la base de datos
    try {
        $sql = "UPDATE pacientes SET 
                    nombres = ?, 
                    apellido_paterno = ?, 
                    apellido_materno = ?, 
                    fecha_nacimiento = ?, 
                    direccion = ?, 
                    telefono = ?, 
                    email = ?, 
                    nombre_contacto_emergencia = ?, 
                    genero = ?, 
                    tipo_documento = ? 
                WHERE numero_documento = ?";
        $stmt = $conexion->pdo->prepare($sql);
        $stmt->execute([$nombres, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $direccion, $telefono, $email, $nombre_contacto_emergencia, $genero, $tipo_documento, $numero_documento]);
        echo "Paciente actualizado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar paciente: " . $e->getMessage();
    }
}

// Cargar datos del paciente a editar
if (isset($_GET['numero_documento'])) {
    $numero_documento = $_GET['numero_documento'];
    $sql = "SELECT * FROM pacientes WHERE numero_documento = :numero_documento";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindValue(':numero_documento', $numero_documento, PDO::PARAM_STR);
    $stmt->execute();
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$paciente) {
        echo "Paciente no encontrado.";
        exit;
    }
} else {
    echo "Número de documento no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Odontología - Editar Paciente</title>
    <?php include_once 'layouts/header.php'; ?>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <!-- Encabezado -->
        <section class="content-header">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="card-header text-center p-4" style="background-color: #007bff; color: white; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
                        <h1 class="card-title" style="font-size: 2.5rem; font-weight: bold;">
                            <i class="fas fa-user-edit" style="margin-right: 10px;"></i>
                            Editar Paciente
                        </h1>
                        <p class="lead mt-2" style="font-size: 1.2rem; font-weight: 300;">Complete el formulario para editar los datos del paciente</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulario de Edición de Pacientes -->
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h2><b>Formulario de Edición</b></h2>
                </div>
                <div class="card-body">
                    <form action="" method="post"> <!-- Aquí se envía el formulario a sí mismo -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Nombres*</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($paciente['nombres']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastNameP">Apellido Paterno*</label>
                                    <input type="text" class="form-control" id="lastNameP" name="lastNameP" value="<?= htmlspecialchars($paciente['apellido_paterno']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastNameM">Apellido Materno*</label>
                                    <input type="text" class="form-control" id="lastNameM" name="lastNameM" value="<?= htmlspecialchars($paciente['apellido_materno']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Fecha de Nacimiento*</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($paciente['fecha_nacimiento']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Género*</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="femenino" <?= ($paciente['genero'] == 'femenino') ? 'selected' : ''; ?>>Femenino</option>
                                        <option value="masculino" <?= ($paciente['genero'] == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                                        <option value="otro" <?= ($paciente['genero'] == 'otro') ? 'selected' : ''; ?>>Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Dirección*</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($paciente['direccion']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Teléfono*</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($paciente['telefono']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico*</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($paciente['email']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="emergencyContact">Contacto de Emergencia*</label>
                                    <input type="text" class="form-control" id="emergencyContact" name="emergencyContact" value="<?= htmlspecialchars($paciente['nombre_contacto_emergencia']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="documentType">Tipo de Documento*</label>
                                    <select class="form-control" id="documentType" name="documentType" required>
                                        <option value="cedula" <?= ($paciente['tipo_documento'] == 'cedula') ? 'selected' : ''; ?>>Cédula de Identidad</option>
                                        <option value="pasaporte" <?= ($paciente['tipo_documento'] == 'pasaporte') ? 'selected' : ''; ?>>Pasaporte</option>
                                        <option value="licencia" <?= ($paciente['tipo_documento'] == 'licencia') ? 'selected' : ''; ?>>Licencia de Conducir</option>
                                        <option value="otro" <?= ($paciente['tipo_documento'] == 'otro') ? 'selected' : ''; ?>>Otro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="documentNumber">Número de Documento*</label>
                                    <input type="text" class="form-control" id="documentNumber" name="documentNumber" value="<?= htmlspecialchars($paciente['numero_documento']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">Actualizar Paciente</button>
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
