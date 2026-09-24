<?php

include("../config/conexion.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM productos WHERE id = $id";

    if(mysqli_query($conexion, $sql)){

        header("Location: productos.php");
        exit();

    } else {

        echo "Error al eliminar producto";

    }

}

?>