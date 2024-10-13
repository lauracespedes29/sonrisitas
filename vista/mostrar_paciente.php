<?php
session_start();
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Inicializar variable para la búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Obtener pacientes de la base de datos con filtro de búsqueda
if ($buscar) {
    // Consulta SQL con filtro de búsqueda
    $sql = "SELECT * FROM pacientes WHERE nombres LIKE :buscar OR numero_documento LIKE :buscar";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindValue(':buscar', '%' . $buscar . '%', PDO::PARAM_STR);
} else {
    // Consulta SQL sin filtro
    $sql = "SELECT * FROM pacientes";
    $stmt = $conexion->pdo->prepare($sql);
}

$stmt->execute();
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once 'layouts/header.php';
?>
<title>SISTEMA ODONTOLOGIA - Mostrar Pacientes</title>
<?php include_once 'layouts/nav.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="card-header">
                    <h1 class="card-title">Mostrar Pacientes</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-2">
                    <a href="pacientes.php" class="btn btn-primary">
                        <i class="fa-solid fa-user-plus"></i> Nuevo Paciente
                    </a>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" name="buscar" class="form-control" placeholder="Buscar Paciente..." aria-label="Buscar Paciente" value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombres</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Género</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo Electrónico</th>
                                <th>Fecha de Registro</th>
                                <th>Contacto de Emergencia</th>
                                <th>Tipo Documento</th>
                                <th>Número de Documento</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pacientes as $paciente): ?>
                                <tr>
                                    <td>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="40" height="40" class="img-fluid">
                                            <circle cx="32" cy="32" r="30" fill="#F5A9BC"/>
                                            <circle cx="32" cy="24" r="10" fill="#FFF"/>
                                            <path d="M24,40 Q32,50 40,40" stroke="#FFF" stroke-width="3" fill="none"/>
                                            <line x1="25" y1="40" x2="20" y2="48" stroke="#FFF" stroke-width="3"/>
                                            <line x1="39" y1="40" x2="44" y2="48" stroke="#FFF" stroke-width="3"/>
                                        </svg>
                                    </td>
                                    <td><?php echo htmlspecialchars($paciente['nombres']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['apellido_paterno']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['apellido_materno']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['genero']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['direccion']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['telefono']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['email']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['created_at']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['nombre_contacto_emergencia']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['tipo_documento']); ?></td>
                                    <td><?php echo htmlspecialchars($paciente['numero_documento']); ?></td>
                                    <td>
                                        <a href="editar_paciente.php?id=<?= $paciente['id_paciente'] ?>" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                                            <i class="fas fa-edit mr-2"></i> Editar
                                        </a>

                                        <a href="eliminar_paciente.php?id=<?= $paciente['id_paciente'] ?>" class="btn btn-outline-danger btn-sm d-flex align-items-center mt-2" onclick="return confirm('¿Estás seguro de que deseas eliminar este paciente?')">
                                            <i class="fas fa-trash-alt mr-2"></i> Eliminar
                                        </a>

                                        <a href="historial_paciente.php?id=<?= $paciente['id_paciente'] ?>" class="btn btn-outline-info btn-sm d-flex align-items-center mt-2">
                                                <i class="fas fa-list mr-2"></i> Historial
                                            </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
include_once 'layouts/footer.php';
?>
