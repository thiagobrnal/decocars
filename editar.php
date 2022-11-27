<link rel="stylesheet" href="stylestock.css">
<?php
if(isset($_GET['editar'])){
	$editar_id = $_GET['editar'];

	$consulta = "SELECT * FROM articulos WHERE id ='$editar_id'";
	$ejecutar = mysqli_query($con, $consulta);

	$fila = mysqli_fetch_array($ejecutar);

			//COMPRUEBA QUE LOS DATOS EXISTAN EN LA BD
	if(isset($fila['nombre'])){
		$cnombre = $fila['nombre'];
	}
	if(isset($fila['precio'])){
		$cprecio = $fila['precio'];
	}
	if(isset($fila['img'])){
		$cimg = $fila['img'];
	}
	if(isset($fila['cantidad'])){
		$ccant = $fila['cantidad'];
	}
}
?>
<br />

			<!--FORMULARIO PARA ACTUALIZAR LOS DATOS-->
<form method="POST" action="">
	<label>Nombre<br></label>
	<input type="text" name="nombre" value="<?php echo $cnombre; ?>"><br />
	<label>Precio<br> </label>
	<input type="number" name="precio" value="<?php echo $cprecio; ?>"><br />
	<label>Imagen<br></label>
	<input type="text" name="img" value="<?php echo $cimg; ?>"><br />
	<label>Cantidad<br></label>
	<input type="number" name="cant" value="<?php echo $ccant; ?>"><br />
	<input type="submit" name="actualizar" value="ACTUALIZAR DATOS">
</form>

<?php

		//ACTUALIZA LOS DATOS
if (isset($_POST['actualizar'])){
$actualizar_nombre = $_POST['nombre'];
$actualizar_precio = $_POST['precio'];
$actualizar_img = $_POST['img'];
$actualizar_cant = $_POST['cant'];

$actualizar = "UPDATE articulos SET nombre='$actualizar_nombre', precio='$actualizar_precio', img='$actualizar_img', cantidad='$actualizar_cant' WHERE id ='$editar_id'";
$ejecutar = mysqli_query($con, $actualizar);

if ($ejecutar){
	echo "<script>alert('Datos Actualizados!')</script>";
	echo "<script>windoows.open('stock.php','_self')</script>";
}
}
?>
