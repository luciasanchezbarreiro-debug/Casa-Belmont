<?php
session_start();

if (isset($_POST['id']) && isset($_POST['cantidad'])) {

    $id = (int) $_POST['id'];
    $cantidad = (int) $_POST['cantidad'];

    if ($cantidad < 1) {
        $cantidad = 1;
    }

    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    }

}

header("Location: carrito.php");
exit();