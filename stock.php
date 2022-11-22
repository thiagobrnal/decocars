<!DOCTYPE html> 
<meta charset="UTF-8">
<link rel="stylesheet" href="stylestock.css">

<?php
include('db.php');
?>

<html>
<head>
	<title>Gestor</title>
	</HEAD><H1>Gestion de stock</H1>
	<meta charset="utf-8">
</head>
<body bgcolor="#aa998c">
    <a href="index.html">Volver</a><br><br>
 <form method="POST" action="stock.php">
	 <label>Codigo<br></label>
	 <input type="numer" name="codigo" placeholder = "Escriba el codigo" required><br />
	 <label>Nombre<br> </label>
	 <input type="text" name="nombre" placeholder = "Escriba el nombre" required><br />
	 <label>Cantidad<br></label>
	 <input type="number" name="cant" placeholder = "Ingrese la cantidad" required><br /><br>
	 <label>Descripcion<br></label>
	 <textarea name="desc"></textarea><br>
	 <input type="submit" name="insert" value = "INSERTAR DATOS">

 </form>

<?php
	if(isset($_POST["insert"])){
		$ccodigo = $_POST["codigo"];
		$cnombre = $_POST["nombre"];
		$ccant = $_POST["cant"];
		$cdesc = $_POST["desc"];

		//$insertar = "INSERT INTO user (codigo,nombre,cantidad,descripcion) VALUES ('$scodigo', '$snombre', '$scant', '$sdesc')";
        $insertar = "INSERT INTO stock (codigo, nombre, cantidad, descripcion) VALUES ('$ccodigo', '$cnombre', '$ccant', '$cdesc')";
		$ejecutar = mysqli_query($con, $insertar);

		if ($ejecutar){
			echo "<h3>Insertado Correctamente</h3>";
		}else{
            echo "<h3>Error al insertar datos</h3>";
        }
	}
?>
<br/>
<center><table id="tabla" width="500" border="2" style="background-color: #F9F9F9;">
	<tr>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>cantidad</th>
		<th>Descripcion</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr></center>
<?php
$consulta = "SELECT * FROM stock";
$ejecutar = mysqli_query($con, $consulta);
$i = 0;
while ( $fila = mysqli_fetch_array($ejecutar)) {

		$ccodigo = $fila["codigo"];
		$cnombre = $fila["nombre"];
		$ccant = $fila["cantidad"];
		$cdesc = $fila["descripcion"];

	$i++;

?>
<tr align="center">
<td><?php echo $ccodigo; ?></td>
<td><?php echo $cnombre; ?></td>
<td><?php echo $ccant; ?></td>
<td><?php echo $cdesc; ?></td>
<td><a href="stock.php?editar=<?php echo $ccodigo; ?>">Editar</a></td>
<td><a href="stock.php?borrar=<?php echo $ccodigo; ?>">Borrar</a></td>
</tr>
<?php } ?>
</table>

<?php
if(isset($_GET['editar'])){
	include("editar.php");
}
?>

<?php
if(isset($_GET['borrar'])){
	$borrar_id = $_GET['borrar'];
	$borrar = "DELETE FROM stock WHERE codigo = '$borrar_id'";
	$ejecutar = mysqli_query($con, $borrar);

	if ($ejecutar){
		echo "<script>alert('El usuario ha sido borrado!')</script>";
		echo "<script>windoows.open('stock.php','_self')</script>";
	}

}
?>
<br><br><br><br><br>
</body>
</html>
