<?php
session_start(); // Comentar si no usas sesión
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

    // Insertar en la base de datos
    try {
        $sql = "INSERT INTO pacientes (nombres, apellido_paterno, apellido_materno, fecha_nacimiento, direccion, telefono, email, nombre_contacto_emergencia, genero, tipo_documento, numero_documento) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->pdo->prepare($sql);
        $stmt->execute([$nombres, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $direccion, $telefono, $email, $nombre_contacto_emergencia, $genero, $tipo_documento, $numero_documento]);
        echo "Paciente registrado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al registrar paciente: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Odontología - Registrar Paciente</title>
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
                            <i class="fas fa-user-plus" style="margin-right: 10px;"></i>
                            Registrar Paciente
                        </h1>
                        <p class="lead mt-2" style="font-size: 1.2rem; font-weight: 300;">Complete el formulario para agregar un nuevo paciente al sistema</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulario de Registro de Pacientes -->
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h2><b>Formulario de Registro</b></h2>
                </div>
                <div class="card-body">
                    <form action="" method="post"> <!-- Aquí se envía el formulario a sí mismo -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Nombres*</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Nombres" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastNameP">Apellido Paterno*</label>
                                    <input type="text" class="form-control" id="lastNameP" name="lastNameP" placeholder="Apellido Paterno" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastNameM">Apellido Materno*</label>
                                    <input type="text" class="form-control" id="lastNameM" name="lastNameM" placeholder="Apellido Materno" required>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Fecha de Nacimiento*</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Género*</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="" disabled selected>Seleccione su género</option>
                                        <option value="femenino">Femenino</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Dirección*</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Dirección" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Teléfono*</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Teléfono" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico*</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required>
                                </div>
                                <div class="form-group">
                                    <label for="emergencyContact">Contacto de Emergencia*</label>
                                    <input type="text" class="form-control" id="emergencyContact" name="emergencyContact" placeholder="Contacto de Emergencia" required>
                                </div>
                                <div class="form-group">
                                    <label for="documentType">Tipo de Documento*</label>
                                    <select class="form-control" id="documentType" name="documentType" required>
                                        <option value="" disabled selected>Seleccione tipo de documento</option>
                                        <option value="cedula">Cédula de Identidad</option>
                                        <option value="pasaporte">Pasaporte</option>
                                        <option value="licencia">Licencia de Conducir</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="documentNumber">Número de Documento*</label>
                                    <input type="text" class="form-control" id="documentNumber" name="documentNumber" placeholder="Número de Documento" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">Registrar Paciente</button>
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
