<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include("../config/conexion.php");

$sql_categorias = "SELECT * FROM categorias";
$resultado_categorias = mysqli_query($conexion, $sql_categorias);


if (isset($_POST["guardar"])) {


    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];


    // Opciones del producto

    $destacado = isset($_POST["destacado"]) ? 1 : 0;

    $oferta = isset($_POST["oferta"]) ? 1 : 0;



    // Imagen

    $imagen = $_FILES["imagen"]["name"];

    $rutaTemporal = $_FILES["imagen"]["tmp_name"];

    $rutaDestino = "../assets/img/productos/" . $imagen;


    move_uploaded_file($rutaTemporal, $rutaDestino);



    $sql = "INSERT INTO productos 
    (nombre, categoria, precio, descripcion, imagen, destacado, oferta)

    VALUES (?, ?, ?, ?, ?, ?, ?)";



    $stmt = $conexion->prepare($sql);



    $stmt->bind_param(
        "ssdssii",
        $nombre,
        $categoria,
        $precio,
        $descripcion,
        $imagen,
        $destacado,
        $oferta
    );



    if($stmt->execute()){

        header("Location: productos.php");

        exit();

    }else{

        echo "Error al guardar el producto.";

    }


}

?>


<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Agregar Producto</title>

<link rel="stylesheet" href="../assets/css/estilos.css">

</head>


<body>


<div class="contenedor-formulario">


<h1>Agregar Producto</h1>



<form method="POST" enctype="multipart/form-data">



<label>Nombre</label>

<input type="text" name="nombre" required>




<label>Categoría</label>

<select name="categoria">


<option>Sala</option>

<option>Comedor</option>

<option>Habitación</option>

<option>Oficina</option>


</select>




<label>Precio</label>

<input type="number" name="precio" required>




<label>Descripción</label>

<textarea name="descripcion" rows="6" required></textarea>




<label>Imagen</label>

<input type="file" name="imagen" required>




<br><br>


<label>

<input type="checkbox" name="destacado">

⭐ Producto Destacado

</label>



<br><br>



<label>

<input type="checkbox" name="oferta">

🔥 Producto En Oferta

</label>




<br><br>



<button type="submit" name="guardar">

Guardar Producto

</button>



<a href="productos.php" class="btn-cancelar">

Cancelar

</a>



</form>


</div>


</body>

</html>