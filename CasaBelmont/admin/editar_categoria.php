<?php

include("../config/conexion.php");


$id = $_GET['id'];


$sql = "SELECT * FROM categorias WHERE id=$id";

$resultado = mysqli_query($conexion, $sql);

$categoria = mysqli_fetch_assoc($resultado);



if(isset($_POST['actualizar'])){


    $nombre = $_POST['nombre'];


    $sql = "UPDATE categorias 
            SET nombre='$nombre' 
            WHERE id=$id";


    mysqli_query($conexion, $sql);


    header("Location: categorias.php");
    exit();

}


?>


<!DOCTYPE html>
<html>

<head>
<title>Editar Categoría</title>
</head>


<body>


<h1>Editar Categoría</h1>


<form method="POST">


<input 
type="text" 
name="nombre" 
value="<?php echo $categoria['nombre']; ?>"
required>


<br><br>


<button name="actualizar">
Actualizar
</button>


</form>


</body>

</html>