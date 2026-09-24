<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include("../config/conexion.php");


$sql_categorias = "SELECT * FROM categorias";
$resultado_categorias = mysqli_query($conexion, $sql_categorias);



if (!isset($_GET['id'])) {

    die("Producto no encontrado.");

}


$id = (int)$_GET['id'];




if (isset($_POST['actualizar'])) {


    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];


    // Opciones

    $destacado = isset($_POST['destacado']) ? 1 : 0;

    $oferta = isset($_POST['oferta']) ? 1 : 0;




    // Imagen actual

    $sqlImagen = "SELECT imagen FROM productos WHERE id=?";

    $stmt = $conexion->prepare($sqlImagen);

    $stmt->bind_param("i",$id);

    $stmt->execute();

    $imagenActual = $stmt->get_result()->fetch_assoc()['imagen'];



    $imagen = $imagenActual;




    // Cambiar imagen

    if(!empty($_FILES['imagen']['name'])){


        $imagen = $_FILES['imagen']['name'];

        $tmp = $_FILES['imagen']['tmp_name'];


        move_uploaded_file(
            $tmp,
            "../assets/img/productos/".$imagen
        );


    }




    $sql = "UPDATE productos SET

            nombre=?,
            categoria=?,
            precio=?,
            descripcion=?,
            imagen=?,
            destacado=?,
            oferta=?

            WHERE id=?";



    $stmt = $conexion->prepare($sql);



    $stmt->bind_param(

        "ssdssiii",

        $nombre,
        $categoria,
        $precio,
        $descripcion,
        $imagen,
        $destacado,
        $oferta,
        $id

    );



    $stmt->execute();



    header("Location: productos.php");

    exit();


}





$sql = "SELECT * FROM productos WHERE id=?";


$stmt = $conexion->prepare($sql);

$stmt->bind_param("i",$id);

$stmt->execute();


$producto = $stmt->get_result()->fetch_assoc();



?>


<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Producto</title>

<link rel="stylesheet" href="../assets/css/estilos.css">

</head>


<body>


<div class="contenedor-formulario">


<h1>Editar Producto</h1>



<form method="POST" enctype="multipart/form-data">



<label>Nombre</label>

<input
type="text"
name="nombre"
value="<?php echo $producto['nombre']; ?>"
required>




<label>Categoría</label>


<select name="categoria">


<?php while($cat = mysqli_fetch_assoc($resultado_categorias)){ ?>


<option

value="<?php echo $cat['nombre']; ?>"

<?php 

if($producto['categoria']==$cat['nombre']){

echo "selected";

}

?>

>

<?php echo $cat['nombre']; ?>


</option>



<?php } ?>


</select>




<label>Precio</label>

<input

type="number"

name="precio"

value="<?php echo $producto['precio']; ?>"

required>




<label>Descripción</label>


<textarea

name="descripcion"

rows="6"

required><?php echo $producto['descripcion']; ?></textarea>





<label>Imagen actual</label>


<br>


<img

src="../assets/img/productos/<?php echo $producto['imagen']; ?>"

width="180">


<br><br>



<label>Cambiar imagen</label>


<input type="file" name="imagen">


<br><br>





<label>


<input

type="checkbox"

name="destacado"

<?php if($producto['destacado']) echo "checked"; ?>


>


⭐ Producto Destacado


</label>




<br><br>




<label>


<input

type="checkbox"

name="oferta"

<?php if($producto['oferta']) echo "checked"; ?>


>


🔥 Producto En Oferta


</label>





<br><br>



<button

type="submit"

name="actualizar">


Actualizar Producto


</button>




<a

href="productos.php"

class="btn-cancelar">


Cancelar


</a>




</form>


</div>


</body>

</html>