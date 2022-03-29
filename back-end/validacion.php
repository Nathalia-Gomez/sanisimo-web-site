<?php
include 'conexion.php';


session_start();

$_SESSION['usuario'] = $_POST['usuario'];
$_SESSION['contrasena'] = $_POST['contrasena'];

$consulta="select * from datos where usuario='$_SESSION[usuario]' and contrasena='$_SESSION[contrasena]' ";
$usuarios=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($usuarios);

if($filas>0)
{ 
    $datos=mysqli_fetch_array($usuarios);
    $_SESSION['nombreap']=$datos['nombreap'];
    header("location:adminp.php");
}
else
{
    mysqli_close($conexion);
    echo "<script>alert('Usuario no válido);</script>";
    echo "<script>window.location='login.php';</script>";
    
    session_destroy();
}
mysqli_free_result($usuarios);

?>