<?php
include_once 'layouts/header.php'; 
include_once '../modelo/conexion.php';

session_start();

if (!isset($_SESSION['us_id'])) {
    header('Location: index.php'); // Redirigir si no está logueado
    exit();
}

$usuario_id = $_SESSION['us_id'];
$citas = $conexion->query("SELECT c.id_cita, u.nombre, u.apellido_paterno, c.fecha, c.motivo, c.estado 
                            FROM citas c 
                            JOIN usuarios u ON c.doctor_id = u.id_usuario 
                            WHERE c.paciente_id = $usuario_id");
?>

<title>Mis Citas</title>
<?php include_once 'layouts/nav.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Mis Citas</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($cita = $citas->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $cita['nombre'] . ' ' . $cita['apellido_paterno']; ?></td>
                                <td><?php echo date('d-m-Y H:i', strtotime($cita['fecha'])); ?></td>
                                <td><?php echo $cita['motivo']; ?></td>
                                <td><?php echo ucfirst($cita['estado']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php include_once 'layouts/footer.php'; ?>
