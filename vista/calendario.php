<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservaciones y Calendario</title>
    <?php include_once 'layouts/header.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn-warning, .btn-danger {
            margin: 0 5px;
        }
        #calendario {
            margin-top: 20px;
        }
        h3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="card-header text-center p-4">
                        <h1 class="card-title" style="font-size: 2.5rem; font-weight: bold;">
                            <i class="fas fa-calendar"></i> Reservaciones y Calendario
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Filtro de Estado -->
                    <form method="GET" class="mb-3">
                        <div class="form-group">
                            <label for="estado">Mostrar Reservaciones:</label>
                            <select name="estado" id="estado" class="form-control" onchange="this.form.submit()">
                                <option value="">Todos</option>
                                <option value="pendiente" <?= isset($_GET['estado']) && $_GET['estado'] == 'pendiente' ? 'selected' : ''; ?>>Pendientes</option>
                                <option value="cobrado" <?= isset($_GET['estado']) && $_GET['estado'] == 'cobrado' ? 'selected' : ''; ?>>Cobrados</option>
                                <option value="cancelado" <?= isset($_GET['estado']) && $_GET['estado'] == 'cancelado' ? 'selected' : ''; ?>>Cancelados</option>
                            </select>
                        </div>
                    </form>

                    <!-- Tabla de Reservaciones -->
                    <h3>Lista de Reservaciones</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Notas</th>
                                    <th>Tratamiento</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
                                $conexion = new Conexion(); // Instancia de la conexión

                                // Obtener todas las citas registradas con tratamientos
                                $estadoFiltro = isset($_GET['estado']) ? $_GET['estado'] : '';
                                $sql = "SELECT c.*, p.nombres, p.apellido_paterno, p.apellido_materno, t.nombre AS tratamiento 
                                        FROM citas c 
                                        JOIN pacientes p ON c.paciente_id = p.id_paciente
                                        LEFT JOIN tratamientos t ON c.id_tratamiento = t.id_tratamiento";

                                // Agregar condición para filtrar por estado
                                if ($estadoFiltro) {
                                    $sql .= " WHERE c.estado = :estado";
                                }

                                $stmt = $conexion->pdo->prepare($sql);
                                if ($estadoFiltro) {
                                    $stmt->bindValue(':estado', $estadoFiltro);
                                }
                                $stmt->execute();
                                $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($citas as $cita):
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($cita['nombres'] . ' ' . $cita['apellido_paterno'] . ' ' . $cita['apellido_materno']); ?></td>
                                    <td><?= htmlspecialchars($cita['fecha']); ?></td>
                                    <td><?= htmlspecialchars($cita['hora']); ?></td>
                                    <td><?= htmlspecialchars($cita['notas']); ?></td>
                                    <td><?= htmlspecialchars($cita['tratamiento']); ?></td>
                                    <td><?= htmlspecialchars($cita['estado']); ?></td>
                                    <td>
                                         <a href="editar_reserva.php?id=<?= $cita['id_cita']; ?>&estado=<?= urlencode($estadoFiltro); ?>" class="btn btn-warning">Editar</a>
                                         <a href="eliminar_reserva.php?id=<?= $cita['id_cita']; ?>&estado=<?= urlencode($estadoFiltro); ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">Eliminar</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    <!-- Calendario -->
                    <h3>Calendario de Reservaciones</h3>
                    <div id="calendario"></div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendario');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: [
                    <?php
                    // Mostrar eventos en el formato que FullCalendar necesita
                    $eventos = []; // Array para almacenar eventos

                    foreach ($citas as $cita) {
                        $titulo = htmlspecialchars($cita['notas']) . ' (' . htmlspecialchars($cita['tratamiento']) . ')'; // Incluir tratamiento en el título
                        $fechaHora = $cita['fecha'] . 'T' . $cita['hora']; // Combinar fecha y hora
                        $eventos[] = "{ title: '$titulo', start: '$fechaHora' }"; // Agregar título al evento
                    }

                    // Unir todos los eventos en una cadena separada por comas
                    echo implode(',', $eventos);
                    ?>
                ]
            });
            calendar.render();
        });

        // Función para mostrar notificaciones de reservas para hoy
        function mostrarNotificaciones() {
            const hoy = new Date().toISOString().slice(0, 10); // Obtener la fecha de hoy en formato YYYY-MM-DD
            const reservasHoy = <?= json_encode($citas); ?>.filter(cita => cita.fecha === hoy); // Filtrar las reservas de hoy

            if (reservasHoy.length > 0) {
                let mensaje = "Reservaciones para hoy:\n";
                reservasHoy.forEach(cita => {
                    mensaje += `${cita.nombres} ${cita.apellido_paterno} ${cita.apellido_materno} a las ${cita.hora}\n`;
                });
                alert(mensaje);
            }
        }

        // Llamar a la función al cargar la página
        window.onload = mostrarNotificaciones;
    </script>
</body>
</html>
