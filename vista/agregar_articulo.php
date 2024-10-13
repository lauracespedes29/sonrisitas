<?php 
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
                <div class="card-header text-center" style="display: flex; align-items: center; justify-content: center; background-color: #004080; box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 8px;">
                    <img src="image.png" alt="Logo Artículos" style="width: 50px; height: 50px; margin-right: 15px;">
                    <h1 class="card-title" style="font-size: 28px; font-weight: 600; color: white;">Lista de Artículos</h1>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#agregarArticuloModal">
                        <i class="fa-solid fa-plus"></i> Nuevo Artículo
                    </button>
                </div>
                <!-- Barra de Búsqueda -->
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar Artículo...">
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

    <!-- Modal para Agregar Artículo -->
    <div class="modal fade" id="agregarArticuloModal" tabindex="-1" role="dialog" aria-labelledby="agregarArticuloModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarArticuloModalLabel">Agregar Nuevo Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarArticulo">
                        <div class="form-group"> 
                            
                            <label for="fotoArticulo">Foto del Artículo:</label>
                            <input type="file" class="form-control-file" id="fotoArticulo" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="tipoArticulo">Tipo de Artículo*</label>
                            <select class="form-control" id="tipoArticulo">
                                <option>-- SELECCIONAR --</option>
                                <option value="Producto">Producto</option>
                                <option value="Servicio">Servicio</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="codigoBarras">Código de Barras*</label>
                            <input type="text" class="form-control" id="codigoBarras" value="1" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombreArticulo">Nombre*</label>
                            <input type="text" class="form-control" id="nombreArticulo" placeholder="Nombre del artículo">
                        </div>
                        <div class="form-group">
                            <label for="descripcionArticulo">Descripción</label>
                            <textarea class="form-control" id="descripcionArticulo" rows="3" placeholder="Información detallada del artículo"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="marcaArticulo">Marca</label>
                            <input type="text" class="form-control" id="marcaArticulo" placeholder="Marca del artículo">
                        </div>
                        <div class="form-group">
                            <label for="categoriaArticulo">Categoría*</label>
                            <select class="form-control" id="categoriaArticulo">
                                <option>-- SELECCIONAR --</option>
                                <option value="Categoria1">Categoría 1</option>
                                <option value="Categoria2">Categoría 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="precioCompra">Precio de Compra*</label>
                            <input type="number" class="form-control" id="precioCompra" placeholder="Precio de compra del artículo">
                        </div>
                        <div class="form-group">
                            <label for="precioVenta">Precio de Venta*</label>
                            <input type="number" class="form-control" id="precioVenta" placeholder="Precio de venta del artículo">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="agregarArticuloBtn">Agregar Artículo</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?php 
include_once 'layouts/footer.php';
?>

<!-- Scripts para Bootstrap y manejo del modal -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Manejo del botón de "Agregar Artículo"
    document.getElementById('agregarArticuloBtn').addEventListener('click', function() {
        const form = document.getElementById('formAgregarArticulo');
        
        // Puedes obtener los valores de los campos así
        const tipo = document.getElementById('tipoArticulo').value;
        const codigoBarras = document.getElementById('codigoBarras').value;
        const nombre = document.getElementById('nombreArticulo').value;
        const descripcion = document.getElementById('descripcionArticulo').value;
        const marca = document.getElementById('marcaArticulo').value;
        const categoria = document.getElementById('categoriaArticulo').value;
        const precioCompra = document.getElementById('precioCompra').value;
        const precioVenta = document.getElementById('precioVenta').value;

        // Por ahora solo muestra los datos en la consola (sin conexión a base de datos)
        console.log({
            tipo,
            codigoBarras,
            nombre,
            descripcion,
            marca,
            categoria,
            precioCompra,
            precioVenta
        });

        alert('Artículo agregado correctamente (simulado)');
        $('#agregarArticuloModal').modal('hide');
    });
</script>
