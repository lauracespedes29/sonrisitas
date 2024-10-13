<?php
session_start(); // Comentar si no usas sesión
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Inicializar variable para la búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Obtener artículos de la base de datos con filtro de búsqueda
if ($buscar) {
    // Consulta SQL con filtro de búsqueda
    $sql = "SELECT * FROM farmacia WHERE nombre_medicamento LIKE :buscar OR categoria LIKE :buscar";
    $stmt = $conexion->pdo->prepare($sql);
    $stmt->bindValue(':buscar', '%' . $buscar . '%', PDO::PARAM_STR);
} else {
    // Consulta SQL sin filtro
    $sql = "SELECT * FROM farmacia";
    $stmt = $conexion->pdo->prepare($sql);
}

$stmt->execute();
$articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once 'layouts/header.php';
?>
<title>SISTEMA ODONTOLOGÍA - Mostrar Artículos</title>
<?php include_once 'layouts/nav.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="card-header">
                    <h1 class="card-title">Mostrar Artículos de Farmacia</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-2">
                    <a href="agregar_articulo.php" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Nuevo Artículo
                    </a>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" name="buscar" class="form-control" placeholder="Buscar Artículo..." aria-label="Buscar Artículo" value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Artículos</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre Medicamento</th>
                                <th>Categoría</th>
                                <th>Fecha Vencimiento</th>
                                <th>Estado</th>
                                <th>Marca</th>
                                <th>Acciones</th> <!-- Columna para acciones -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($articulos) > 0): ?>
                                <?php foreach ($articulos as $articulo): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($articulo['nombre_medicamento']) ?></td>
                                        <td><?= htmlspecialchars($articulo['categoria']) ?></td>
                                        <td><?= htmlspecialchars($articulo['fecha_vencimiento']) ?></td>
                                        <td><?= htmlspecialchars($articulo['estado']) ?></td>
                                        <td><?= htmlspecialchars($articulo['marca']) ?></td>
                                        <td>
                                            <a href="editar_articulo.php?nombre=<?= urlencode($articulo['nombre_medicamento']) ?>&categoria=<?= urlencode($articulo['categoria']) ?>&fecha_vencimiento=<?= urlencode($articulo['fecha_vencimiento']) ?>&marca=<?= urlencode($articulo['marca']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="eliminar_articulo.php?nombre=<?= urlencode($articulo['nombre_medicamento']) ?>&categoria=<?= urlencode($articulo['categoria']) ?>&fecha_vencimiento=<?= urlencode($articulo['fecha_vencimiento']) ?>&marca=<?= urlencode($articulo['marca']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este artículo?');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay artículos registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'layouts/footer.php'; ?>
