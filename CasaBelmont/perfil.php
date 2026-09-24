<?php
session_start();

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

include("includes/header.php");
include("includes/navbar.php");
?>

<main>

<section class="perfil">

    <div class="perfil-card">

        <h1>Mi Perfil</h1>

        <p class="bienvenida">
            Bienvenido a Casa Belmont
        </p>

        <div class="datos">

            <p>
                <strong>Nombre:</strong><br>
                <?php echo $_SESSION['usuario_nombre']; ?>
            </p>

            <p>
                <strong>Correo:</strong><br>
                <?php echo $_SESSION['usuario_correo']; ?>
            </p>

        </div>

        <div class="perfil-botones">

            <a href="mis_pedidos.php" class="btn-perfil">
                📦 Mis pedidos
            </a>

            <a href="logout.php" class="btn-salir">
                Cerrar sesión
            </a>

        </div>

    </div>

</section>

</main>

<?php
include("includes/footer.php");
?>