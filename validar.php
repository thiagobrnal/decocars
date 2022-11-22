<?php

include('db.php');

      //COMPRUEBA QUE EL USUARIO Y CONTRASEÑA SEAN CORRECTOS
$usuario=$_POST['usuario'];
$contraseña=$_POST['contraseña'];
session_start();
$_SESSION['usuario']=$usuario;

$consulta="SELECT*FROM usuarios where usuario='$usuario' and password='$contraseña'";
$resultado=mysqli_query($con,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
    header("location:indexadmin.html");

}else{
    ?>
    <?php
    include("login.html");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($con);