<link rel="stylesheet" href="stylestock.css">
<?php
if(isset($_GET['editar'])){
	$editar_id = $_GET['editar'];

	$consulta = "SELECT * FROM stock WHERE codigo='$editar_id'";
	$ejecutar = mysqli_query($con, $consulta);

	$fila = mysqli_fetch_array($ejecutar);

	if(isset($fila['codigo'])){
		$ccodigo = $fila['codigo'];
	}
	if(isset($fila['nombre'])){
		$cnombre = $fila['nombre'];
	}
	if(isset($fila['cantidad'])){
		$ccant = $fila['cantidad'];
	}
	if(isset($fila['descripcion'])){
		$cdesc = $fila['descripcion'];
	}	
}
?>
<br />
<form method="POST" action="">
<label>Codigo<br></label>
<input type="number" name="codigo" value="<?php echo $ccodigo; ?>"><br />
<label>Nombre<br> </label>
<input type="text" name="nombre" value="<?php echo $cnombre; ?>"><br />
<label>Cantidad<br></label>
<input type="number" name="cant" value="<?php echo $ccant; ?>"><br />
<label>Descripcion</label><br>
<textarea name="desc" value="<?php echo $cdesc; ?>"></textarea><br>
<input type="submiT" name="actualizar" value="ACTUALIZAR DATOS">
</form>

<?php
if (isset($_POST['actualizar'])){
$actualizar_codigo = $_POST['codigo'];
$actualizar_nombre = $_POST['nombre'];
$actualizar_cant = $_POST['cant'];
$actualizar_desc = $_POST['desc'];

$actualizar = "UPDATE stock SET nombre='$actualizar_nombre', cantidad='$actualizar_cant', descripcion='$actualizar_desc' WHERE codigo='$editar_id'";
$ejecutar = mysqli_query($con, $actualizar);

if ($ejecutar){
	echo "<script>alert('Datos Actualizados!')</script>";
	echo "<script>windoows.open('stock.php','_self')</script>";
}
}
?>
