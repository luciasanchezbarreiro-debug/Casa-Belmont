<?php

include("../config/conexion.php");

$sql = "SELECT * FROM categorias";
$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
</head>

<body>

<h1>Administrar Categorías</h1>

<a href="agregar_categoria.php">
    Nueva Categoría
</a>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Acciones</th>
</tr>


<?php while($categoria = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td>
<?php echo $categoria['id']; ?>
</td>

<td>
<?php echo $categoria['nombre']; ?>
</td>

<td>

<a href="editar_categoria.php?id=<?php echo $categoria['id']; ?>">
Editar
</a>


<a href="eliminar_categoria.php?id=<?php echo $categoria['id']; ?>"
onclick="return confirm('¿Eliminar categoría?')">
Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>