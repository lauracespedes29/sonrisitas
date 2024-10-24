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
                        <h1 class="card-title">Mostrar Usuarios</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <!-- New User Button -->
                <div class="col-md-2">
                    <a href="nuevoUsuario.php" class="btn btn-primary">
                        <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
                    </a>
                </div>
                <!-- Search Bar -->
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar Usuario...">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
                <div class="card card-info card-outline">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Rol</th>
                                        <th>Documento</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="/smileapp/img/avatar.png" class="img-fluid" alt="Foto" width="40"></td>
                                        <td>Administrador</td>
                                        <td>DNI - 12345678</td>
                                        <td>Admin Tarea Completa</td>
                                        <td>admin@gmail.com</td>
                                        <td>957716730</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                                        </td>
                                    </tr>
                                    <!-- Additional rows go here -->
                                </tbody>
                            </table>
                        </div>
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