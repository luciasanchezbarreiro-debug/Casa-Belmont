<?php

include("../config/conexion.php");


if(isset($_POST['guardar'])){

    $nombre = $_POST['nombre'];

    $sql = "INSERT INTO categorias(nombre) VALUES('$nombre')";

    mysqli_query($conexion, $sql);

    header("Location: categorias.php");
    exit();

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Agregar Categoría</title>
</head>

<body>

<h1>Nueva Categoría</h1>


<form method="POST">

<label>
Nombre de categoría:
</label>

<br>

<input type="text" name="nombre" required>


<br><br>


<button type="submit" name="guardar">
Guardar
</button>


</form>


</body>
</html>