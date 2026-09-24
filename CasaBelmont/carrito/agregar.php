<?php
session_start();
include("../config/conexion.php");

// Verificar que llegue un ID
if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id = (int) $_GET['id'];

// Buscar el producto
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows == 0) {
    header("Location: ../index.php");
    exit();
}

$producto = $resultado->fetch_assoc();

// Si el carrito no existe, lo creamos
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Si el producto ya está en el carrito, aumentar cantidad
if (isset($_SESSION['carrito'][$id])) {

    $_SESSION['carrito'][$id]['cantidad']++;

} else {

    $_SESSION['carrito'][$id] = [
        "id" => $producto['id'],
        "nombre" => $producto['nombre'],
        "precio" => $producto['precio'],
        "imagen" => $producto['imagen'],
        "cantidad" => 1
    ];

}

// Redirigir al carrito
header("Location: carrito.php");
exit();