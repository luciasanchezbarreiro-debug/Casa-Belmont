<?php

include("config/conexion.php");


if(isset($_GET['categoria'])){


    $categoria = $_GET['categoria'];


    $sql = "SELECT * FROM productos 
            WHERE categoria='$categoria'
            ORDER BY fecha DESC";


}else{


    $sql = "SELECT * FROM productos 
            ORDER BY fecha DESC";


}



$resultado = mysqli_query($conexion, $sql);


?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Catálogo | Casa Belmont</title>

<link rel="stylesheet" href="assets/css/estilos.css">

</head>


<body>


<header class="header-productos">

<h1>Casa Belmont</h1>

<p>Encuentra muebles elegantes para tu hogar</p>

</header>



<main>


<section class="catalogo">


<?php while($producto = mysqli_fetch_assoc($resultado)){ ?>


<div class="card-catalogo">


<div class="imagen-catalogo">


<img 
src="assets/img/productos/<?php echo $producto['imagen']; ?>"
alt="<?php echo $producto['nombre']; ?>"
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



<div class="acciones-producto">


<a 
href="carrito/agregar.php?id=<?php echo $producto['id']; ?>"
class="btn-carrito">

🛒 Agregar al carrito

</a>


</div>


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