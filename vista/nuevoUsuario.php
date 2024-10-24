<?php 
include_once 'layouts/header.php';
?>

<title>Agregar Usuario</title>

<?php
include_once 'layouts/nav.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-3">
            <div class="col-sm-12">
                <h1 class="card-title">Agregar Usuario Nuevo</h1>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <form action="/smileapp/controlador/nuevoUsuarioController.php" method="POST">
                    <div class="form-group">
                        <label for="firstName">Nombre*</label>
                        <input type="text" class="form-control" id="firstName" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Apellido*</label>
                        <input type="text" class="form-control" id="lastName" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico*</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña*</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo de Usuario*</label>
                        <select class="form-control" id="type" name="tipo" required>
                            <option value="1">Admin</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php 
include_once 'layouts/footer.php';
?>
