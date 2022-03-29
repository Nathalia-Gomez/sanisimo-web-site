<?php

session_start();
$varsesion=$_SESSION['usuario'];
if($varsesion==null || $varsesion= '')
{
    echo 'Sin autorización';
    die();
}

include 'conexion.php';

$sentencia= "select * from datos";
$resultado=mysqli_query($conexion, $sentencia);
$nfilas=mysqli_num_rows($resultado);


if(isset($_REQUEST['id_datos'])) 
{
    $id_datos=$_REQUEST['id_datos'];
    $usuario=$_REQUEST['usuario'];
    $contrasena=$_REQUEST['contrasena'];
    $nombreap=$_REQUEST['nombreap'];
    $insertar="insert into datos (usuario, contrasena, nombreap) values ('$usuario', '$contrasena', '$nombreap')"; 
            mysqli_query($conexion, $insertar);
            echo"<script>alert('Registro Exitoso')</script>";
            echo"<script>window.location='usuarios.php</script>";
} 

if(isset($_REQUEST['eliminar']))
{
    $eliminar=$_REQUEST['eliminar'];
    mysqli_query($conexion, "delete from datos where id_datos=$eliminar");
    echo "<script>alert('Registro Eliminado');</script>";
    echo "<script>window.location='usuarios.php'</script>";

}

if(isset($_REQUEST['editar']))
{
    $editar=$_REQUEST['editar'];
    $registros=mysqli_query($conexion, "select * from datos where id_datos=$editar");
    $regular=mysqli_fetch_array($registros);
}

if(isset($_REQUEST['clave']))
{
    $id_datos=$_REQUEST['clave'];
    $usuario=$_REQUEST['usuario'];
    $contrasena=$_REQUEST['contrasena'];
    $nombreap=$_REQUEST['nombreap'];
        mysqli_query($conexion, "update datos set usuario='$usuario', contrasena='$contrasena', nombreap='$nombreap' where id_datos='$id_datos'");
             echo '<script>alert("Registro Actualizado")</script>';
             echo "<script>window.location='usuarios.php'</script>";              
       
        }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SANISIMO</title>
    <meta name="keyword" content="Sanisimo">
    <meta name="description" content="Tienda de productos saludables">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/tables.css">
    <link rel="stylesheet" href="css/fontello.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>

<body>
    <section id="contenedor">
       <header>
       <div>
           <h1 class="titulo"></h1>
           <img src="img/logooo.png" alt="granola">
       </div>
       
       <div>
            <nav class="menu">
                <a href="adminp.php">Sistema</a>
                <a href="categorias.php">Categorias</a>
                <a href="comentarios.php">Comentarios</a>
                <a href="noticias.php">Noticias</a>
                <a href="usuarios.php">Usuarios</a>
                <a href="productos.php">Productos</a>
                <a href="btrabajo.php">Bolsa de trabajo</a>
                <a href="bentregas.php">Entregas domicilio</a>
                <a href="cerrarlogin.php">Cerrar Sesión</a>
            </nav>
        </div>       
    </header>
    
    <!--section#informacion>h2+div>p-->
    <section id="inf">
            <div class="contenedor"> <!--raro-->
            <div class="cont">
              <br/>
              <br/>
               <center>
                           
		<h1>Lista de usuarios de sistema: </h1>
		<br/><br/>
		 <table>
			<tr>
				<td>ID</td>
				<td>Usuario</td>
                <td>Contraseña</td>
				<td>Nombre Completo</td>
				<td></td>
				<td></td>
			</tr>
               <?php while($datos=mysqli_fetch_array($resultado)){ ?>
               <tr>
                <td > <?php echo $datos['id_datos'];?></td>
                <td > <?php echo $datos['usuario'];?><br></td>
               <td > <?php echo $datos['contrasena'];?><br></td>
               <td > <?php echo $datos['nombreap'];?></td>
               <td><a onclick="return preguntar()" href="usuarios.php?eliminar=<?php echo $datos['id_datos'];?>"> Eliminar</a></td>
                <td><a href="usuarios.php?editar=<?php echo $datos['id_datos'];?>">Editar</a></td>
            </tr>
				<?php } ?>	
		</table>
		<br/>
		<br/>
		<hr>
		<br/>
		<h3>Ingresar usuarios administradores:</h3>
       <br/>
		   <form action="usuarios.php" method="post">
         
          <input type="hidden" name="id_datos" <?php if(isset($_REQUEST['editar'])){echo "value='".$regular['id_datos']."' readonly disabled";} ?>>
          
          <input type="text" name="usuario" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['usuario']."' ";}?>placeholder="Usuario" size="50"><br/><br/>
          
          <input type="text" name="contrasena" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['contrasena']."' ";}?>placeholder="Contraseña" size="50"><br/><br/>
          
          <input type="text" name="nombreap" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['nombreap']."' ";}?>placeholder="Nombre completo" size="50"><br/><br/>
          
          
           <br/>
            <br/>
           <?php 
            if(isset($_REQUEST['editar'])){
               echo"<input type='hidden' name='clave' value='".$regular['id_datos']."'>";
           }
           
           ?>
             <input type="submit" <?php if(isset($_REQUEST['editar'])) {echo "value='Guardar'";} else {"value='insertar'";}?> id="boton">
    </form>
		
<hr>

       

	</center>
            </div>
            </div>
    </section>
   </section>
    <!--footer>div>p+div>a*4-->
    <footer>
        <div class="contenedor">
            <p class="texto">Sanísimo S.A de C.V. Parrilla II. Villahermosa, Tabasco. México.</p>
            <div class="logos">
                <a class="icon-facebook" href="https://facebook.com"></a>
                <a class="icon-twitter" href="https://twitter.com"></a>
                <a class="icon-instagram" href="https://instagram.com"></a>
                <a class="icon-youtube" href="https://youtube.com"></a>
            </div>
        </div>
    </footer>
    
    
</body>
</html>