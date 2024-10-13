<?php 
/*session_start();
if($_SESSION['us_tipo']==1){*/
include_once 'layouts/header.php';
?>
    <title>SISTEMA ODONTOLOGÍA - Lista de Artículos</title>
<?php
include_once 'layouts/nav.php';
?>
<div class="content-wrapper">
<!-- Encabezado de la página -->
<section class="content-header">
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="card-header text-center" 
                style="display: flex; align-items: center; justify-content: center; 
                background-color: #1e3d59;  /* Azul oscuro elegante */
                padding: 20px; border-radius: 8px; color: #ffffff; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);">
                
                <img src="imagen.png" alt="Logo Artículos" 
                    style="width: 50px; height: 50px; margin-right: 15px; border-radius: 50%; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
                
                <h1 class="card-title" style="font-size: 30px; font-weight: 700; margin: 0;">
                    Lista de Artículos
                </h1>
            </div>
        </div>
    </div>
</section>


    <!-- Botón y barra de búsqueda -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <!-- Nuevo Artículo Button -->
                <div class="col-md-2">
                    <a href="agregar_articulo.php" class="btn btn-primary" style="width: 100%; box-shadow: 0px 4px 10px rgba(0, 123, 255, 0.4);">
                        <i class="fa-solid fa-plus mr-2"></i> Nuevo Artículo
                    </a>
                </div>
                <!-- Barra de Búsqueda -->
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar Artículo..." style="border-radius: 0.25rem;">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button" style="box-shadow: 0px 4px 10px rgba(40, 167, 69, 0.4);">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabla de Artículos -->
    <section class="content">
        <div class="card card-info card-outline" style="border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
            <!-- Cuerpo de la Tarjeta -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead style="background-color: #007bff; color: white;">
                            <tr>
                                <th>Foto</th>
                                <th>Código</th>
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Categoría</th>
                                <th>Compra $</th>
                                <th>Venta $</th>
                                <th>Stock</th>
                                <th>Usuario</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="ruta_de_imagen.jpg" alt="Foto Artículo" style="width: 40px; height: 40px; border-radius: 5px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
                                </td>
                                <td>1</td>
                                <td>Servicio</td>
                                <td>Tratamiento Estético</td>
                                <td>N/A</td>
                                <td>Servicios</td>
                                <td>N/A</td>
                                <td>300.00</td>
                                <td>N/A</td>
                                <td>Aaron Atoche</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary btn-sm d-flex align-items-center" style="box-shadow: 0px 2px 5px rgba(0, 0, 123, 255, 0.2);">
                                        <i class="fas fa-edit mr-2"></i> Editar
                                    </a>
                                    <a href="#" class="btn btn-outline-danger btn-sm d-flex align-items-center mt-2" style="box-shadow: 0px 2px 5px rgba(255, 0, 0, 0.2);">
                                        <i class="fas fa-trash-alt mr-2"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                            <!-- Agregar más filas aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
include_once 'layouts/footer.php';
/*}
// else {
//     header('Location: /smileapp/vista/index.php');
 }*/
?> 
