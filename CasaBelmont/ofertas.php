<?php

include("config/conexion.php");


// Productos seleccionados como oferta

$sql = "SELECT * FROM productos WHERE oferta = 1 ORDER BY id DESC";


$resultado = mysqli_query($conexion,$sql);


?>


<!DOCTYPE html>
<html lang="es">


<head>

<meta charset="UTF-8">

<title>Ofertas | Casa Belmont</title>

<link rel="stylesheet" href="assets/css/estilos.css">

</head>


<body>


<header class="header-productos">

<h1>
🔥 Ofertas especiales
</h1>

<p>
Muebles premium con precios increíbles
</p>

</header>




<main>


<section class="catalogo">



<?php while($producto = mysqli_fetch_assoc($resultado)){ ?>


<div class="card-catalago">



<div class="imagen-catalago">


<img src="assets/img/productos/<?php echo $producto['imagen']; ?>">


</div>




<div class="info-catalogo">



<span class="categoria">

OFERTA 🔥

</span>




<h2>

<?php echo $producto['nombre']; ?>

</h2>




<p>

<?php echo $producto['descripcion']; ?>

</p>




<h3 class="precio-oferta">

$<?php echo number_format($producto['precio'],0,",","."); ?>

</h3>




<a 
href="carrito/agregar.php?id=<?php echo $producto['id']; ?>"
class="btn-carrito">

🛒 Comprar ahora

</a>




</div>



</div>



<?php } ?>



</section>



</main>



<footer>

<p>
© <?php echo date("Y"); ?> Casa Belmont - Muebles Premium
</p>

</footer>



</body>


</html>