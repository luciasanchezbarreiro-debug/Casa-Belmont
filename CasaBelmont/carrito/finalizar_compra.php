<?php

session_start();

include("../config/conexion.php");


// Verificar que exista carrito

if(!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])){

    header("Location: carrito.php");
    exit();

}


// Cuando envía el formulario

if(isset($_POST['confirmar'])){


    $nombre = $_POST['nombre'];

    $telefono = $_POST['telefono'];

    $direccion = $_POST['direccion'];



    $total = 0;


    foreach($_SESSION['carrito'] as $producto){

        $total += $producto['precio'] * $producto['cantidad'];

    }




    // Guardar pedido

    $sql = "INSERT INTO pedidos
    (nombre_cliente, telefono, direccion, total)

    VALUES

    ('$nombre','$telefono','$direccion','$total')";


    mysqli_query($conexion,$sql);



    $pedido_id = mysqli_insert_id($conexion);




    // Guardar detalle pedido

    foreach($_SESSION['carrito'] as $producto){


        $sql = "INSERT INTO detalle_pedidos

        (pedido_id, producto_id, nombre_producto, cantidad, precio)

        VALUES

        ('$pedido_id',
        '".$producto['id']."',
        '".$producto['nombre']."',
        '".$producto['cantidad']."',
        '".$producto['precio']."')";



        mysqli_query($conexion,$sql);


    }




    // Vaciar carrito

    unset($_SESSION['carrito']);



    header("Location: ../pedido_exitoso.php");

    exit();


}


?>



<!DOCTYPE html>

<html lang="es">


<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Finalizar compra | Casa Belmont</title>


<link rel="stylesheet" href="../assets/css/estilos.css">


</head>



<body>



<main class="checkout-container">


<div class="checkout-card">



<h1>
Finalizar compra
</h1>



<p class="checkout-subtitulo">

Completa tus datos para recibir tus muebles

</p>




<form method="POST">



<label>
Nombre completo
</label>



<input

type="text"

name="nombre"

placeholder="Ej: Carlos Pérez"

required>



<label>
Teléfono
</label>



<input

type="text"

name="telefono"

placeholder="Ej: 3001234567"

required>



<label>
Dirección de entrega
</label>



<textarea

name="direccion"

placeholder="Ej: Calle 10 #20-30, Villavicencio"

required></textarea>




<button

type="submit"

name="confirmar">

Confirmar pedido 🛒

</button>



</form>



</div>



</main>



</body>


</html>