<?php

include("../config/conexion.php");


if(isset($_GET['id'])){


    $id = $_GET['id'];


    $sql = "DELETE FROM categorias WHERE id=$id";


    if(mysqli_query($conexion, $sql)){


        header("Location: categorias.php");
        exit();


    }else{


        echo "Error al eliminar categoría";


    }


}else{


    echo "Categoría no encontrada";


}

?>