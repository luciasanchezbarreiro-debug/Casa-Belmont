<?php

session_start();


if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}


include("../config/conexion.php");



$sql = "SELECT * FROM pedidos ORDER BY fecha DESC";

$resultado = mysqli_query($conexion, $sql);



?>


<!DOCTYPE html>

<html lang="es">


<head>

<meta charset="UTF-8">

<title>Pedidos | Casa Belmont</title>

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





<div class="encabezado-admin">



<h1>

🛒 Administrar Pedidos

</h1>



</div>






<table class="tabla-admin">





<thead>


<tr>


<th>ID</th>

<th>Cliente</th>

<th>Teléfono</th>

<th>Dirección</th>

<th>Total</th>

<th>Estado</th>

<th>Fecha</th>

<th>Acción</th>


</tr>


</thead>





<tbody>





<?php while($pedido = mysqli_fetch_assoc($resultado)){ ?>





<tr>




<td>

<?php echo $pedido['id']; ?>

</td>





<td>

<?php echo $pedido['nombre_cliente']; ?>

</td>





<td>

<?php echo $pedido['telefono']; ?>

</td>





<td>

<?php echo $pedido['direccion']; ?>

</td>





<td>

$<?php echo number_format($pedido['total'],0,",","."); ?>

</td>





<td>

<form method="POST" action="actualizar_estado.php">


<input 
type="hidden" 
name="id" 
value="<?php echo $pedido['id']; ?>">



<select name="estado">


<option value="Pendiente"
<?php if($pedido['estado']=="Pendiente") echo "selected"; ?>>
Pendiente
</option>



<option value="Confirmado"
<?php if($pedido['estado']=="Confirmado") echo "selected"; ?>>
Confirmado
</option>



<option value="Enviado"
<?php if($pedido['estado']=="Enviado") echo "selected"; ?>>
Enviado
</option>



<option value="Entregado"
<?php if($pedido['estado']=="Entregado") echo "selected"; ?>>
Entregado
</option>



<option value="Cancelado"
<?php if($pedido['estado']=="Cancelado") echo "selected"; ?>>
Cancelado
</option>


</select>



<button class="btn-editar">

Guardar

</button>



</form>


</td>




<td>

<?php echo $pedido['fecha']; ?>

</td>





<td>



<a

href="detalle_pedido.php?id=<?php echo $pedido['id']; ?>"

class="btn-editar">


Ver pedido


</a>




</td>





</tr>





<?php } ?>





</tbody>





</table>






</main>






</div>





</body>


</html>