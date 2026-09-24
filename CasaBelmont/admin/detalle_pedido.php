<?php

session_start();


if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}


include("../config/conexion.php");



if(!isset($_GET['id'])){

    header("Location: pedidos.php");
    exit();

}



$id = $_GET['id'];




// Buscar pedido

$sql = "SELECT * FROM pedidos WHERE id='$id'";

$resultado = mysqli_query($conexion,$sql);


$pedido = mysqli_fetch_assoc($resultado);



// Buscar productos del pedido

$sql_detalle = "SELECT * FROM detalle_pedidos WHERE pedido_id='$id'";


$detalles = mysqli_query($conexion,$sql_detalle);



?>



<!DOCTYPE html>

<html lang="es">


<head>


<meta charset="UTF-8">


<title>Detalle Pedido | Casa Belmont</title>


<link rel="stylesheet" href="../assets/css/estilos.css">


</head>



<body>




<div class="dashboard">





<aside class="sidebar">


<h2>

Casa Belmont

</h2>


<ul>


<li>

<a href="dashboard.php">

🏠 Dashboard

</a>

</li>


<li>

<a href="productos.php">

📦 Productos

</a>

</li>


<li>

<a href="categorias.php">

📂 Categorías

</a>

</li>


<li>

<a href="pedidos.php">

🛒 Pedidos

</a>

</li>


<li>

<a href="logout.php">

🚪 Cerrar sesión

</a>

</li>


</ul>


</aside>








<main class="contenido">



<h1>

📄 Pedido #<?php echo $pedido['id']; ?>

</h1>




<div class="card-dashboard">


<h2>

Datos del cliente

</h2>


<p>

<strong>Nombre:</strong>

<?php echo $pedido['nombre_cliente']; ?>

</p>



<p>

<strong>Teléfono:</strong>

<?php echo $pedido['telefono']; ?>

</p>



<p>

<strong>Dirección:</strong>

<?php echo $pedido['direccion']; ?>

</p>



<p>

<strong>Total:</strong>

$<?php echo number_format($pedido['total'],0,",","."); ?>

</p>



</div>








<br>





<h2>

Productos comprados

</h2>





<table class="tabla-admin">



<thead>


<tr>


<th>Producto</th>

<th>Cantidad</th>

<th>Precio</th>

<th>Subtotal</th>


</tr>


</thead>




<tbody>





<?php while($detalle = mysqli_fetch_assoc($detalles)){ ?>



<tr>



<td>

<?php echo $detalle['nombre_producto']; ?>

</td>




<td>

<?php echo $detalle['cantidad']; ?>

</td>




<td>

$<?php echo number_format($detalle['precio'],0,",","."); ?>

</td>





<td>

$<?php echo number_format($detalle['precio'] * $detalle['cantidad'],0,",","."); ?>

</td>



</tr>



<?php } ?>





</tbody>



</table>





<br>



<a href="pedidos.php" class="btn-agregar">

← Volver a pedidos

</a>





</main>





</div>






</body>


</html>