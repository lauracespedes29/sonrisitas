<?php
session_start();
include_once '../modelo/conexion.php'; // Asegúrate de que la ruta sea correcta
$conexion = new Conexion(); // Instancia de la conexión

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre_medicamento = $_POST['nombre_medicamento'];
    $categoria = $_POST['categoria'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $estado = $_POST['estado']; // Asegúrate de que esto se reciba
    $marca = $_POST['marca'];

    // Actualizar en la base de datos
    try {
        $sql = "UPDATE farmacia SET categoria = ?, fecha_vencimiento = ?, estado = ?, marca = ? WHERE nombre_medicamento = ?";
        $stmt = $conexion->pdo->prepare($sql);
        $stmt->execute([$categoria, $fecha_vencimiento, $estado, $marca, $nombre_medicamento]);
        echo "Artículo actualizado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
}

// Obtener datos del artículo a editar
$nombre = $_GET['nombre'];
$categoria = $_GET['categoria'];
$fecha_vencimiento = $_GET['fecha_vencimiento'];
$marca = $_GET['marca'];

// Obtener el estado del artículo desde la base de datos
$sql = "SELECT estado FROM farmacia WHERE nombre_medicamento = ? AND categoria = ? AND fecha_vencimiento = ? AND marca = ?";
$stmt = $conexion->pdo->prepare($sql);
$stmt->execute([$nombre, $categoria, $fecha_vencimiento, $marca]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica si se encontró el artículo y obtiene el estado
if ($resultado) {
    $estado = $resultado['estado'];
} else {
    // Manejo de error si no se encuentra el artículo
    die("Artículo no encontrado.");
}

include_once 'layouts/header.php';
?>
<title>SISTEMA ODONTOLOGÍA - Editar Artículo</title>
<?php include_once 'layouts/nav.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar Artículo</h1>
    </section>
    <section class="content">
        <form method="post" action="">
            <input type="hidden" name="nombre_medicamento" value="<?= htmlspecialchars($nombre) ?>">
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <input type="text" class="form-control" id="categoria" name="categoria" value="<?= htmlspecialchars($categoria) ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?= htmlspecialchars($fecha_vencimiento) ?>" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="vigente" <?= ($estado == 'vigente') ? 'selected' : '' ?>>Vigente</option>
                    <option value="vencido" <?= ($estado == 'vencido') ? 'selected' : '' ?>>Vencido</option>
                </select>
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?= htmlspecialchars($marca) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Artículo</button>
        </form>
    </section>
</div>

<?php include_once 'layouts/footer.php'; ?>
