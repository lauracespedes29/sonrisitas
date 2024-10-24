<?php
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Inicializar variable para la búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Inicializar la variable de pacientes
$pacientes = [];

if ($buscar) {
    // Obtener pacientes de la base de datos con filtro de búsqueda
    $sql = "SELECT * FROM pacientes WHERE nombres LIKE :buscar OR numero_documento LIKE :buscar";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindValue(':buscar', '%' . $buscar . '%', PDO::PARAM_STR);
    $stmt->execute();
    $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservación de Citas - Buscar Paciente</title>
    <?php include_once 'layouts/header.php'; ?>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Buscar Paciente para Reservar Cita</h1>
        </section>
        
        <section class="content">
            <!-- Formulario de Búsqueda -->
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar Paciente por Nombre o Documento" aria-label="Buscar Paciente">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>

            <!-- Resultados de Búsqueda -->
            <?php if (!empty($pacientes)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Número de Documento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pacientes as $paciente): ?>
                                <tr>
                                    <td><?= htmlspecialchars($paciente['nombres']); ?></td>
                                    <td><?= htmlspecialchars($paciente['apellido_paterno']); ?></td>
                                    <td><?= htmlspecialchars($paciente['apellido_materno']); ?></td>
                                    <td><?= htmlspecialchars($paciente['telefono']); ?></td>
                                    <td><?= htmlspecialchars($paciente['email']); ?></td>
                                    <td><?= htmlspecialchars($paciente['numero_documento']); ?></td>
                                    <td>
                                     <a href="registrar_reserva.php?paciente_id=<?= $paciente['id_paciente']; ?>" class="btn btn-primary">Registrar Reserva</a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No se encontraron pacientes.</p>
            <?php endif; ?>

            <!-- Botón de Agregar Paciente (no redirige por ahora) -->
            <a href="pacientes.php" class="btn btn-secondary">Agregar Paciente</a>

        </section>
    </div>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
