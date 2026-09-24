<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras - Casa Belmont</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>

<body>

<div class="contenedor-carrito">

    <h1 class="titulo-carrito">🛒 Mi Carrito</h1>

    <?php if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) { ?>

        <div class="carrito-vacio">
            <h2>Tu carrito está vacío</h2>
            <p>Explora nuestro catálogo y encuentra el mueble ideal para tu hogar.</p>

            <a href="../index.php" class="btn-seguir">
                Seguir comprando
            </a>
        </div>

    <?php } else { ?>

    <?php $total = 0; ?>

    <?php foreach($_SESSION['carrito'] as $producto){

        $subtotal = $producto['precio'] * $producto['cantidad'];
        $total += $subtotal;

    ?>

    <div class="card-carrito">

        <div class="card-imagen">

            <img src="../assets/img/productos/<?php echo $producto['imagen']; ?>">

        </div>

        <div class="card-info">

            <h2><?php echo $producto['nombre']; ?></h2>

            <p class="precio">
                $<?php echo number_format($producto['precio'],0,",","."); ?>
            </p>

            <form action="actualizar.php" method="POST" class="cantidad">

                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

                <input
                    type="number"
                    name="cantidad"
                    min="1"
                    max="99"
                    value="<?php echo $producto['cantidad']; ?>">

                <button>
                    Actualizar
                </button>

            </form>

            <p class="subtotal">

                Subtotal:
                <strong>

                    $<?php echo number_format($subtotal,0,",","."); ?>

                </strong>

            </p>

        </div>

        <div class="card-acciones">

            <a href="eliminar.php?id=<?php echo $producto['id']; ?>" class="btn-eliminar">

                🗑

            </a>

        </div>

    </div>

    <?php } ?>

    <div class="resumen-compra">

        <h2>

            Total:
            $<?php echo number_format($total,0,",","."); ?>

        </h2>

        <div class="botones-finales">

            <a href="../index.php" class="btn-seguir">

                ← Seguir comprando

            </a>

           <a href="finalizar_compra.php" class="btn-finalizar">

                Finalizar compra

           </a>
        </div>

    </div>

    <?php } ?>

</div>

</body>

</html>