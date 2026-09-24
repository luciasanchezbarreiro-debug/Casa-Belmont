<?php
session_start();
include("../config/conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM administradores WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {

        $admin = $resultado->fetch_assoc();

        if (password_verify($password, $admin["password"])) {

            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_nombre"] = $admin["nombre"];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Contraseña incorrecta.";
        }

    } else {
        $error = "El usuario no existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>

<div class="login-admin">

    <form method="POST" class="form-login">

        <h1>Casa Belmont</h1>
        <h2>Panel de Administración</h2>

        <?php if($error != ""){ ?>
            <div class="mensaje-error">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <input
            type="text"
            name="usuario"
            placeholder="Usuario"
            required>

        <input
            type="password"
            name="password"
            placeholder="Contraseña"
            required>

        <button type="submit">
            Iniciar sesión
        </button>

    </form>

</div>

</body>
</html>