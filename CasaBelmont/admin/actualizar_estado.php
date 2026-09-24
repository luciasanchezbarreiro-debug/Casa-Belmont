<?php

include("../config/conexion.php");


if(isset($_POST['id'])){


$id = $_POST['id'];

$estado = $_POST['estado'];



$sql = "UPDATE pedidos 
SET estado='$estado'
WHERE id='$id'";



mysqli_query($conexion,$sql);



header("Location: pedidos.php");

exit();


}

?>