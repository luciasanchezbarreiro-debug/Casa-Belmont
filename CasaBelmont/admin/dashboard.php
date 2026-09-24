<?php

session_start();


if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}


include("../config/conexion.php");



// Contar productos

$sql_productos = "SELECT COUNT(*) AS total FROM productos";

$resultado_productos = mysqli_query($conexion,$sql_productos);

$productos = mysqli_fetch_assoc($resultado_productos)['total'];




// Contar pedidos

$sql_pedidos = "SELECT COUNT(*) AS total FROM pedidos";

$resultado_pedidos = mysqli_query($conexion,$sql_pedidos);

$pedidos = mysqli_fetch_assoc($resultado_pedidos)['total'];




// Total vendido

$sql_ventas = "SELECT SUM(total) AS total FROM pedidos";

$resultado_ventas = mysqli_query($conexion,$sql_ventas);

$ventas = mysqli_fetch_assoc($resultado_ventas)['total'];

if($ventas == null){

    $ventas = 0;

}



?>



<!DOCTYPE html>

<html lang="es">


<head>

<meta charset="UTF-8">

<title>Dashboard | Casa Belmont</title>

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

Bienvenido, <?php echo $_SESSION['admin_nombre']; ?> 👋

</h1>



<p>

Panel administrativo Casa Belmont

</p>






<div class="cards-dashboard">





<div class="card-dashboard">


<h2>
📦 Productos
</h2>


<p>

<?php echo $productos; ?>

productos registrados

</p>


</div>







<div class="card-dashboard">


<h2>
🛒 Pedidos
</h2>


<p>

<?php echo $pedidos; ?>

pedidos realizados

</p>


</div>







<div class="card-dashboard">


<h2>
💰 Ventas
</h2>


<p>

$<?php echo number_format($ventas,0,",","."); ?>



</p>


</div>






</div>





</main>





</div>



</body>


</html>