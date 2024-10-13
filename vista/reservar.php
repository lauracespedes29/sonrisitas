<?php 
    include_once 'layouts/header.php'; 
?>
<title>Reservar Cita</title>

<!-- Estilos adicionales -->
<style>
    .content-wrapper {
        background-color: #f9f9f9; /* Fondo muy claro para todo el contenido */
        padding: 30px;
    }
    .card {
        background-color: #ffffff; /* Fondo blanco para las tarjetas */
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .card-header h1 {
        font-weight: 700;
        font-size: 1.8rem;
        color: black
        ; /* Texto en gris oscuro */
        margin-bottom: 0;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 12px;
        font-size: 1.1rem;
        background-color: #ffffff; /* Fondo blanco para el campo de texto */
    }
    .btn-custom {
        font-size: 1rem;
        padding: 12px 20px;
        margin-left: 5px;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }
    .btn-primary-custom {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }
    .btn-primary-custom:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .btn-secondary-custom {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
    .btn-secondary-custom:hover {
        background-color: #218838;
        border-color: #218838;
    }
    p {
        font-size: 1.1rem;
        color: black; /* Texto gris oscuro, mayor legibilidad */
    }
    .input-group-append .btn {
        border-radius: 10px;
    }
    .input-group .form-control {
        border-right: none;
        background-color: black; /* Fondo blanco para el campo de búsqueda */
        color: #333333; /* Texto oscuro */
    }
    .input-group-append .btn {
        background-color: #007bff; /* Botón azul */
        border-color: #007bff;
        color: white;
    }
    .input-group-append .btn:hover {
        background-color: #0056b3;
        border-color: Black;
    }
</style>

<?php include_once 'layouts/nav.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="card-header">
                    <h1 class="card-title"><i class="fas fa-calendar-alt"></i> Reservar Cita</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline shadow">
                <div class="card-body">
                    <!-- Formulario para buscar paciente -->
                    <p>Buscar cliente por su número de identificación, nombre, apellido o correo electrónico:</p>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Buscar cliente..." aria-label="Buscar cliente...">
                        <div class="input-group-append">
                            <button class="btn btn-primary-custom btn-custom" type="button"><i class="fas fa-search"></i> Buscar</button>
                        </div>
                    </div>

                    <!-- Botón para registrar un nuevo paciente -->
                    <a href="registrar_paciente.php" class="btn btn-secondary-custom btn-custom">
                        <i class="fas fa-user-plus"></i> Nuevo Paciente
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
    include_once 'layouts/footer.php'; 
?>
