<?php
// Iniciar sesión
session_start();
include_once '../modelo/conexion.php'; // Incluir la conexión a la base de datos
$conexion = new Conexion(); // Instancia de la conexión

// Verificar si se han enviado los parámetros 'nombres' y 'apellido_paterno'
if (isset($_GET['nombres']) && isset($_GET['apellido_paterno'])) {
    $nombres = urldecode($_GET['nombres']);
    $apellido_paterno = urldecode($_GET['apellido_paterno']);
    
    // Buscar al paciente por nombres y apellido_paterno
    $sql = "SELECT * FROM pacientes WHERE nombres = :nombres AND apellido_paterno = :apellido_paterno";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindParam(':nombres', $nombres, PDO::PARAM_STR);
    $stmt->bindParam(':apellido_paterno', $apellido_paterno, PDO::PARAM_STR);
    $stmt->execute();
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el paciente
    if (!$paciente) {
        echo "Paciente no encontrado.";
        exit;
    }
} else {
    echo "Nombres o Apellido Paterno no proporcionados.";
    exit;
}

// Si se han enviado los datos del formulario (actualización)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    
    // Actualizar los datos del paciente en la base de datos
    $sql = "UPDATE pacientes SET 
                nombres = :nombres, 
                apellido_paterno = :apellido_paterno, 
                apellido_materno = :apellido_materno, 
                telefono = :telefono,
                email = :email
            WHERE nombres = :original_nombres AND apellido_paterno = :original_apellido_paterno";
    
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellido_paterno', $apellido_paterno);
    $stmt->bindParam(':apellido_materno', $apellido_materno);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':original_nombres', $_POST['original_nombres']);
    $stmt->bindParam(':original_apellido_paterno', $_POST['original_apellido_paterno']);
    
    if ($stmt->execute()) {
        echo "Paciente actualizado correctamente.";
        header("Location: mostrar_paciente.php"); // Redirigir a la página de pacientes
    } else {
        echo "Error al actualizar el paciente.";
    }
}
?>

<!-- Formulario para editar paciente -->
<?php include_once 'layouts/header.php'; ?>
<title>Editar Paciente</title>
<?php include_once 'layouts/nav.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar Paciente</h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" value="<?= htmlspecialchars($paciente['nombres']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="<?= htmlspecialchars($paciente['apellido_paterno']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="<?= htmlspecialchars($paciente['apellido_materno']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($paciente['telefono']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($paciente['email']) ?>" required>
                </div>

                <!-- Guardar los valores originales para la actualización -->
                <input type="hidden" name="original_nombres" value="<?= htmlspecialchars($paciente['nombres']) ?>">
                <input type="hidden" name="original_apellido_paterno" value="<?= htmlspecialchars($paciente['apellido_paterno']) ?>">

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </section>
</div>

<?php include_once 'layouts/footer.php'; ?>
