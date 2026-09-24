<?php

session_start();

if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}


include("../config/conexion.php");


$sql = "SELECT * FROM productos ORDER BY id DESC";

$resultado = $conexion->query($sql);


?>


<!DOCTYPE html>

<html lang="es">


<head>

<meta charset="UTF-8">

<title>Administrar Productos</title>

<link rel="stylesheet" href="../assets/css/estilos.css">

</head>



<body>



<div class="contenedor-admin">



<div class="encabezado-admin">


<h1>
📦 Administrar Productos
</h1>



<a href="agregar_producto.php" class="btn-agregar">

+ Agregar Producto

</a>



</div>





<table class="tabla-admin">


<thead>


<tr>

<th>ID</th>

<th>Imagen</th>

<th>Nombre</th>

<th>Categoría</th>

<th>Precio</th>

<th>Destacado</th>

<th>Ofertas</th>

<th>Acciones</th>


</tr>


</thead>



<tbody>



<?php while($producto = $resultado->fetch_assoc()){ ?>



<tr>



<td>

<?php echo $producto['id']; ?>

</td>




<td>


<img

src="../assets/img/productos/<?php echo $producto['imagen']; ?>"

width="80">


</td>




<td>

<?php echo $producto['nombre']; ?>

</td>




<td>

<?php echo $producto['categoria']; ?>

</td>




<td>

$<?php echo number_format($producto['precio'],0,",","."); ?>

</td>




<td>


<?php

echo $producto['destacado'] ? "⭐ Sí" : "No";

?>


</td>

<td>

<?php
echo $producto['oferta'] ? "🔥 Sí" : "No";
?>

</td>




<td>



<a

href="editar_producto.php?id=<?php echo $producto['id']; ?>"

class="btn-editar">

Editar

</a>




<a

href="eliminar_producto.php?id=<?php echo $producto['id']; ?>"

class="btn-eliminar-admin"

onclick="return confirm('¿Eliminar este producto?')">

Eliminar

</a>



</td>




</tr>



<?php } ?>



</tbody>



</table>



</div>



</body>


</html>