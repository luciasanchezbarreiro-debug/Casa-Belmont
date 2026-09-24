<?php

include("config/conexion.php");


if(isset($_GET['buscar'])){

    $buscar = $_GET['buscar'];

    $sql = "SELECT * FROM productos 
            WHERE nombre LIKE '%$buscar%'
            OR categoria LIKE '%$buscar%'";

}else{

    $sql = "SELECT * FROM productos";

}


$resultado = mysqli_query($conexion,$sql);


?>


<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Buscar productos | Casa Belmont</title>

<link rel="stylesheet" href="assets/css/estilos.css">

</head>


<body>



<header class="header-productos">

<h1>
🔍 Buscar productos
</h1>

</header>




<main>


<section class="catalogo">



<?php while($producto = mysqli_fetch_assoc($resultado)){ ?>



<div class="card-catalago">


<div class="imagen-catalago">


<img 
src="assets/img/productos/<?php echo $producto['imagen']; ?>"
>



</div>



<div class="info-catalogo">


<span class="categoria">

<?php echo $producto['categoria']; ?>

</span>



<h2>

<?php echo $producto['nombre']; ?>

</h2>



<p>

<?php echo $producto['descripcion']; ?>

</p>



<h3>

$<?php echo number_format($producto['precio'],0,",","."); ?>

</h3>



<a 
href="carrito/agregar.php?id=<?php echo $producto['id']; ?>"
class="btn-carrito">

🛒 Agregar al carrito

</a>



</div>



</div>



<?php } ?>



</section>



</main>



</body>

</html>