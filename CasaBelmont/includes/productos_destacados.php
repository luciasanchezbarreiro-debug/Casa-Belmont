<?php
include("config/conexion.php");

$sql = "SELECT * FROM productos WHERE destacado = 1 LIMIT 8";
$resultado = $conexion->query($sql);
?>

<section class="productos">

    <div class="contenedor">

        <div class="titulo-seccion">
            <h2>Productos Destacados</h2>
            <p>Descubre algunos de nuestros muebles más populares.</p>
        </div>

        <div class="grid-productos">

            <?php while($producto = $resultado->fetch_assoc()) { ?>

                <div class="card-producto">

                    <img src="assets/img/productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">

                    <div class="info-producto">

                        <h3><?php echo $producto['nombre']; ?></h3>

                        <p class="categoria">
                            <?php echo $producto['categoria']; ?>
                        </p>

                        <p class="precio">
                            $<?php echo number_format($producto['precio'], 0, ",", "."); ?>
                        </p>

                        <div class="botones">

                            <a href="detalle.php?id=<?php echo $producto['id']; ?>" class="btn-ver">
                                Ver más
                            </a>

                           <a href="carrito/agregar.php?id=<?php echo $producto['id']; ?>" class="btn-carrito">
                              Agregar
                           </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>