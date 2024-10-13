<?php 
    include_once 'layouts/header.php'; 
?>
<title>Historial del Paciente</title>

<!-- Añadimos el estilo de Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Estilos personalizados para mejorar tipografía y diseño -->
<style>
    body {
        font-family: 'Roboto', sans-serif;
        color: #343a40; /* Color base para el texto */
    }
    .content-wrapper {
        background-color: #f8f9fa;
    }
    .card-header h1 {
        font-weight: 700;
        font-size: 1.8rem;
        color: white ; /* Cabl}mbiado a gris oscuro en lugar de azul */
    }
    .card-title {
        color: #555; /* Tono neutro para el título */
    }
    .card-body h3 {
        font-weight: 500;
        color: white; /* Tono gris neutro para los subtítulos */
        margin-bottom: 20px;
    }
    .table thead {
        background-color: #6c757d; /* Tono gris oscuro en lugar de azul */
        color: white;
        font-weight: 500;
    }
    .table td, .table th {
        padding: 12px;
        vertical-align: middle;
    }
    .btn-outline-primary, .btn-outline-success, .btn-outline-secondary {
        font-weight: 500;
        font-size: 0.9rem;
        border-radius: 5px;
    }
    .btn-outline-primary:hover, .btn-outline-success:hover, .btn-outline-secondary:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease-in-out;
    }
</style>

<?php include_once 'layouts/nav.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="card-header">
                    <h1 class="card-title">Historial del Paciente</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline shadow">
                <div class="card-body">
                    <!-- Información del Paciente -->
                    <div class="mb-4">
                        <h3><i class="fas fa-user"></i> Información del Paciente</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nombres:</strong> Laura Cespedes Quispe</p>
                                <p><strong>Fecha de Nacimiento:</strong> 29-08-2005</p>
                                <p><strong>Teléfono:</strong> 61127274</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Correo Electrónico:</strong> lauracama734@gmail.com</p>
                                <p><strong>Dirección:</strong> Zona 12 de Octubre, Calle Raul Salmon</p>
                                <p><strong>Fecha de Registro:</strong> 29-10-2024</p>
                            </div>
                        </div>
                    </div>

                    <!-- Historial de Consultas -->
                    <h3><i class="fas fa-notes-medical"></i> Historial de Consultas</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Consulta</th>
                                    <th>Tratamiento</th>
                                    <th>Medicación</th>
                                    <th>Doctor</th>
                                    <th>Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10-01-2024</td>
                                    <td>Chequeo General</td>
                                    <td>Limpieza Dental</td>
                                    <td>Enjuague bucal</td>
                                    <td>Dr. Juan Perez</td>
                                    <td>Sin complicaciones</td>
                                </tr>
                                <tr>
                                    <td>15-06-2024</td>
                                    <td>Consulta de Dolor</td>
                                    <td>Extracción de Muelas</td>
                                    <td>Ibuprofeno 400mg</td>
                                    <td>Dr. Ana Lopez</td>
                                    <td>Recetado analgésico, revisión en 1 semana</td>
                                </tr>
                                <!-- Más filas de historial aquí -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Opciones adicionales del historial -->
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="mostrar_paciente.php" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Volver a Pacientes
                        </a>
                        <div>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-print"></i> Imprimir Historial
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="fas fa-file-export"></i> Exportar PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
    include_once 'layouts/footer.php'; 
?>
