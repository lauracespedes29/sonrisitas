<?php /*
session_start();
if($_SESSION['us_tipo']==1){*/
    include_once 'layouts/header.php';
?>
        <title>SISTEMA ODONTOLOGIA</title>
<?php
    include_once 'layouts/nav.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="card-header">
                        <h1 class="card-title">Agregar Usuario Nuevo</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <form>
                    <div class="col-md-4">
                            <label for="profilePic">Foto 400x400</label>
                            <input type="file" class="btn btn-outline-info btn-block btn-flat" id="profilePic" accept="image/jpeg">
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="firstName">Nombre*</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Apellido*</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Apellidos" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo*</label>
                            <select class="form-control" id="type" required>
                                <option value="">-- SELECCIONAR --</option>
                                <option value="admin">Admin</option>
                                <option value="user">Usuario</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="commission">Comisión (%)</label>
                            <input type="number" class="form-control" id="commission" value="0" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Usuario/Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" placeholder="Usuario/Correo electrónico" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php 
include_once 'layouts/footer.php'
/*
}
else{
    header('Location: /smileapp/vista/index.php');
}*/
?>