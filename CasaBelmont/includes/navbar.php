<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">

    <div class="contenedor nav">

        <!-- Logo -->
        <div class="logo">

            <a href="index.php">

                <img src="assets/img/logo/logo.png" alt="Casa Belmont">

            </a>

        </div>

        <!-- Menú -->
        <nav class="menu">

            <ul>

                <li>
                    <a class="activo" href="index.php">
                        Inicio
                    </a>
                </li>

                <li>
                    <a href="productos.php">
                        Catálogo
                    </a>
                </li>

                <li>
                    <a href="ofertas.php">
                        Ofertas
                    </a>
                </li>

                <li>
                    <a href="nosotros.php">
                        Nosotros
                    </a>
                </li>

                <li>
                    <a href="contacto.php">
                        Contacto
                    </a>
                </li>

            </ul>

        </nav>

        <!-- Buscador -->
        <form action="buscador.php" method="GET" class="buscador">

            <input
                type="text"
                name="buscar"
                placeholder="Buscar productos..."
                required
            >

            <button type="submit">

                <i class="fa-solid fa-magnifying-glass"></i>

            </button>

        </form>

        <!-- Iconos -->
        <div class="iconos">

            <?php if(isset($_SESSION["usuario_id"])){ ?>

                <a href="perfil.php" class="usuario-logueado">

                    <i class="fa-solid fa-user"></i>

                    <?php echo $_SESSION["usuario_nombre"]; ?>

                </a>

                <a href="logout.php" title="Cerrar sesión">

                    <i class="fa-solid fa-right-from-bracket"></i>

                </a>

            <?php }else{ ?>

                <a href="login.php">

                    <i class="fa-regular fa-user"></i>

                </a>

            <?php } ?>

            <a href="carrito/carrito.php">

                <i class="fa-solid fa-cart-shopping"></i>

                <span class="contador">

                    0

                </span>

            </a>

        </div>

    </div>

</header>