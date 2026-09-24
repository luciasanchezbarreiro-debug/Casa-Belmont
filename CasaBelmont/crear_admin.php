<?php
include("config/conexion.php");

$nombre = "Administrador";
$usuario = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$sql = "INSERT INTO administradores (nombre, usuario, password)
VALUES ('$nombre', '$usuario', '$password')";

if ($conexion->query($sql)) {
    echo "Administrador creado correctamente.";
} else {
    echo "Error: " . $conexion->error;
}
?>