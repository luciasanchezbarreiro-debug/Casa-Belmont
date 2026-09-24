<?php
session_start();
include("config/conexion.php");

$mensaje = "";

if(isset($_POST['registrar'])){

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

    // Verificar contraseñas
    if($password != $confirmar){

        $mensaje = "Las contraseñas no coinciden.";

    }else{

        // Verificar correo existente
        $sql = "SELECT id FROM usuarios WHERE correo=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($resultado->num_rows > 0){

            $mensaje = "El correo ya está registrado.";

        }else{

            // Encriptar contraseña
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios(nombre, apellido, correo, telefono, password)
                    VALUES(?,?,?,?,?)";

            $stmt = $conexion->prepare($sql);

            $stmt->bind_param(
                "sssss",
                $nombre,
                $apellido,
                $correo,
                $telefono,
                $passwordHash
            );

            if($stmt->execute()){

                header("Location: login.php?registro=ok");
                exit();

            }else{

                $mensaje = "Error al registrar usuario.";

            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registro | Casa Belmont</title>

<link rel="stylesheet" href="assets/css/estilos.css">

</head>

<body>

<div class="login-admin">

<div class="form-login">

<h1>Casa Belmont</h1>

<h2>Crear Cuenta</h2>

<?php if($mensaje != ""){ ?>

<div class="mensaje-error">

<?php echo $mensaje; ?>

</div>

<br>

<?php } ?>

<form method="POST">

<input
type="text"
name="nombre"
placeholder="Nombre"
required>

<input
type="text"
name="apellido"
placeholder="Apellido"
required>

<input
type="email"
name="correo"
placeholder="Correo electrónico"
required>

<input
type="text"
name="telefono"
placeholder="Teléfono"
required>

<input
type="password"
name="password"
placeholder="Contraseña"
required>

<input
type="password"
name="confirmar"
placeholder="Confirmar contraseña"
required>

<button
type="submit"
name="registrar">

Registrarse

</button>

</form>

<br>

<p style="text-align:center;">

¿Ya tienes cuenta?

<a href="login.php">

Inicia sesión

</a>

</p>

</div>

</div>

</body>

</html>