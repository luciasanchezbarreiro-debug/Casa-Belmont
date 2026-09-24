<?php
session_start();

// Verificar que llegue el ID
if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    // Si existe el producto en el carrito, eliminarlo
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }

}

// Volver al carrito
header("Location: carrito.php");
exit();