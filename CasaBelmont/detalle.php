<?php
include("config/conexion.php");

// Verificar que se recibió el ID
if (!isset($_GET['id'])) {
    die("Producto no encontrado.");
}

$id = $_GET['id'];

// Buscar el producto
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows == 0) {
    die("Producto no encontrado.");
}

$producto = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $producto['nombre']; ?></title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

<div class="contenedor">

    <div class="detalle-producto">

        <div class="imagen-producto">
            <img src="assets/img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
        </div>

        <div class="info-producto">

            <h1><?php echo $producto['nombre']; ?></h1>

            <h2>$<?php echo number_format($producto['precio'], 0, ",", "."); ?></h2>

            <p><?php echo $producto['descripcion']; ?></p>

           
            <a href="carrito/agregar.php?id=<?php echo $producto['id']; ?>" class="btn-ver">
               Agregar al carrito
            </a>

        </div>

    </div>

</div>

</body>
</html>