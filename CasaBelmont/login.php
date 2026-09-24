<?php
session_start();
include("config/conexion.php");

if(isset($_POST["ingresar"])){

    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE correo=?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s",$correo);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){

        $usuario = $resultado->fetch_assoc();

        if(password_verify($password,$usuario["password"])){

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nombre"] = $usuario["nombre"];
            $_SESSION["usuario_correo"] = $usuario["correo"];

            header("Location: index.php");
            exit();

        }else{

            $error = "Contraseña incorrecta.";

        }

    }else{

        $error = "El correo no está registrado.";

    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Iniciar Sesión | Casa Belmont</title>

<link rel="stylesheet" href="assets/css/estilos.css">

</head>

<body class="login-admin">

<div class="form-login">

<h1>Casa Belmont</h1>

<h2>Iniciar Sesión</h2>

<?php if(isset($error)){ ?>

<div class="mensaje-error">

<?php echo $error; ?>

</div>

<br>

<?php } ?>

<form method="POST">

<input
type="email"
name="correo"
placeholder="Correo electrónico"
required>

<input
type="password"
name="password"
placeholder="Contraseña"
required>

<button
type="submit"
name="ingresar">

Ingresar

</button>

</form>

<br>

<p style="text-align:center;">

¿No tienes cuenta?

<a href="registro.php">

Regístrate aquí

</a>

</p>

</div>

</body>
</html>