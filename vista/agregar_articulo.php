<?php
session_start(); // Comentar si no usas sesión
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre_medicamento = $_POST['nombre_medicamento'];
    $categoria = $_POST['categoria'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $estado = $_POST['estado'];
    $marca = $_POST['marca'];
    // Insertar en la base de datos
    try {
        $sql = "INSERT INTO farmacia (nombre_medicamento, categoria, fecha_vencimiento, estado, marca) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->pdo->prepare($sql);
        $stmt->execute([$nombre_medicamento, $categoria, $fecha_vencimiento, $estado, $marca]);
        echo "registrado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al registrar : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Odontología - Registrar Artículo de Farmacia</title>
    <?php include_once 'layouts/header.php'; ?>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <!-- Encabezado -->
        <section class="content-header">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="card-header text-center p-4" style="background-color: #007bff; color: white; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
                        <h1 class="card-title" style="font-size: 2.5rem; font-weight: bold;">
                            <i class="fas fa-pills" style="margin-right: 10px;"></i>
                            Registrar Artículo 
                        </h1>
                        <p class="lead mt-2" style="font-size: 1.2rem; font-weight: 300;">Complete el formulario para agregar un nuevo artículo </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulario de Registro de Artículos de Farmacia -->
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    <h2><b>Formulario de Registro</b></h2>
                </div>
                <div class="card-body">
                    <form action="" method="post"> <!-- Aquí se envía el formulario a sí mismo -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_medicamento">Nombre del Medicamento*</label>
                                    <input type="text" class="form-control" id="nombre_medicamento" name="nombre_medicamento" placeholder="Nombre del Medicamento" required>
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Categoría*</label>
                                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoría" required>
                                </div>
                          
                                <div class="form-group">
                                    <label for="fecha_vencimiento">Fecha de Vencimiento*</label>
                                    <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca*</label>
                                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado">Estado*</label>
                                    <select class="form-control" id="estado" name="estado" required>
                                        <option value="vigente" selected>Vigente</option>
                                        <option value="vencido">Vencido</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">Registrar Artículo</button>
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
