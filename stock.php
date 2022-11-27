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
    <a href="indexadmin.html" class = "btn" style= " background: #302d29; padding: 5px; box-shadow: 0 0.3rem 5rem rgb(0 0 0 / 50%); color: #dfdbd6;">Volver</a><br><br>

			<!--FORMULARIO PRINCIPAL-->
 <form method="POST" action="stock.php">
	 <label>Nombre<br> </label>
	 <input type="text" name="nombre" placeholder = "Nombre del producto" required><br />
	 <label>Precio<br></label>
	 <input type="number" name="precio" placeholder = "Ingrese el precio" required><br /><br>
	 <label>Nombre imagen (sin extensiones)<br></label>
	 <input type="text" name="img" placeholder = "Ej: lampara" required><br /><br>
	 <label>cantidad<br></label>
	 <input type="text" name="cant" placeholder = "Ingrese la cantidad" required><br /><br>
	 <input type="submit" name="insert" value = "INSERTAR DATOS">
 </form>

<?php

			//RECIBE LOS DATOS DEL FORMULARIO Y LOS SUBE A AL BD
	if(isset($_POST["insert"])){
		$cnombre = $_POST["nombre"];
		$cprecio = $_POST["precio"];
		$cimg = $_POST["img"];
		$ccant = $_POST["cant"];

        $insertar = "INSERT INTO articulos (nombre, precio, img, cantidad) VALUES ('$cnombre', '$cprecio', '$cimg', '$ccant')";
		$ejecutar = mysqli_query($con, $insertar);

		if ($ejecutar){
			echo "<h3>Insertado Correctamente</h3>";
		}else{
            echo "<h3>Error al insertar datos</h3>";
        }
	}
?>
<br/>

			<!--CREA LA TABLA DONDE SE VAN A VER LOS DATOS-->
<center><table id="tabla" width="500" border="2" style="background-color: #F9F9F9;">
	<tr>
		<th>id</th>
		<th>nombre</th>
		<th>precio</th>
		<th>img</th>
		<th>cantidad</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr></center>
<?php
$consulta = "SELECT * FROM articulos";
$ejecutar = mysqli_query($con, $consulta);
$i = 0;
while ( $fila = mysqli_fetch_array($ejecutar)) {

		$cid = $fila["id"];
		$cnombre = $fila["nombre"];
		$cprecio = $fila["precio"];
		$cimg = $fila["img"];
		$ccant = $fila["cantidad"];

	$i++;

?>
		<!--PONE LOS DATOS DE LA BD EN LA TABLA-->
<tr align="center">
<td><?php echo $cid; ?></td>
<td><?php echo $cnombre; ?></td>
<td><?php echo $cprecio; ?></td>
<td><?php echo $cimg; ?></td>
<td><?php echo $ccant; ?></td>
<td><a href="stock.php?editar=<?php echo $cid; ?>">Editar</a></td>
<td><a href="stock.php?borrar=<?php echo $cid; ?>">Borrar</a></td>
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
	$borrar = "DELETE FROM articulos WHERE id = '$borrar_id'";
	$ejecutar = mysqli_query($con, $borrar);

		//MENSAJE DE ALERTA
	if ($ejecutar){
		echo "<script>alert('El usuario ha sido borrado!')</script>";
		echo "<script>windoows.open('stock.php','_self')</script>";
	}

}
?>
<br><br><br><br>
<MARQUEE DIRECTION="RIGHT" BEHAVIOR="ALTERNATE" BGCOLOR = "#dfdbd6">
<FONT COLOR="BLACK">
¡ADVERTENCIA!<br>
Para que los cambios se apliquen<br>
actualizar la pagina</FONT></MARQUEE>
</body>
</html>
