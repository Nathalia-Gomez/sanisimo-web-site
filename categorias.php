<?php

session_start();
$varsesion=$_SESSION['usuario'];
if($varsesion==null || $varsesion= '')
{
    echo 'Usted no tiene autorización no es personal autorizado';
    die();
}

include 'conexion.php';

$sentencia= "select * from categorias";
$resultado=mysqli_query($conexion, $sentencia);
$nfilas=mysqli_num_rows($resultado);


if(isset($_REQUEST['id_categorias'])) 
{
    $id_categorias=$_REQUEST['id_categorias'];
    $nombre=$_REQUEST['nombre'];
    $definicion=$_REQUEST['definicion'];
    $imagenc=$_REQUEST['imagenc'];
    $subio=false;
    $directorio='archivos'; 
    $imagenc=$directorio."/".$_FILES['imagenc']['name'];
    
    if(is_uploaded_file($_FILES['imagenc']['tmp_name']))
    {
        move_uploaded_file($_FILES['imagenc']['tmp_name'], $imagenc);
        $subio=true;
        if($subio)
        {
    $insertar="insert into categorias (nombre, definicion, imagenc) values ('$nombre', '$definicion', '$imagenc')"; 
            mysqli_query($conexion, $insertar);
            echo"<script>alert('Registro Exitoso')</script>";
            echo"<script>window.location='categorias.php</script>";
        }
        else
        {
            echo"<script>alert('Error')</script>";
        }
    }
}

if(isset($_REQUEST['eliminar']))
{
    $eliminar=$_REQUEST['eliminar'];
    mysqli_query($conexion, "delete from categorias where id_categorias=$eliminar");
    echo "<script>alert('Registro Eliminado');</script>";
    echo "<script>window.location='categorias.php'</script>";

}

if(isset($_REQUEST['editar']))
{
    $editar=$_REQUEST['editar'];
    $registros=mysqli_query($conexion, "select * from categorias where id_categorias=$editar");
    $regular=mysqli_fetch_array($registros);
}

if(isset($_REQUEST['clave']))
{
    $id_categorias=$_REQUEST['clave'];
    $nombre=$_REQUEST['nombre'];
    $definicion=$_REQUEST['definicion'];
    $imagenc=$_REQUEST['imagenc'];
    $subio=false;
    $directorio='archivos'; 
    $imagenc=$directorio."/".$_FILES['imagenc']['name'];
    
    if(is_uploaded_file($_FILES['imagenc']['tmp_name']))
    {
        move_uploaded_file($_FILES['imagenc']['tmp_name'], $imagenc);
        $subio=true;
        if($subio)
        {
        mysqli_query($conexion, "update categorias set nombre='$nombre', definicion='$definicion', imagenc='$imagenc' where id_categorias='$id_categorias'");
             echo '<script>alert("Registro Actualizado")</script>';
             echo "<script>window.location='categorias.php'</script>";              
       
        }
        else
        {
            echo"<script>alert('Error')</script>";
        }
    }
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
                           
		<h1>Lista de categorías: </h1>
		
		 <table>
			<tr>
				<td>ID</td>
				<td>Nombre</td>
                <td>Definición</td>
                <td></td>
				<td></td>
				<td></td>
			</tr>
               <?php while($categorias=mysqli_fetch_array($resultado)){ ?>
               <tr>
                <td > <?php echo $categorias['id_categorias'];?></td>
               <td > <?php echo $categorias['nombre'];?><br></td>
               <td > <?php echo $categorias['definicion'];?></td>
               <td > <img src="<?php echo $categorias['imagenc']; ?>"></td>
               <td><a onclick="return preguntar()" href="categorias.php?eliminar=<?php echo $categorias['id_categorias'];?>"> Eliminar</a></td>
                <td><a href="categorias.php?editar=<?php echo $categorias['id_categorias'];?>">Editar</a></td>
            </tr>
				<?php } ?>	
		</table>
		<br/>
		<br/>
		<hr>
		<br/>
		<h3>Ingresar categorias:</h3>
       <br/>
		   <form action="categorias.php" method="post" enctype="multipart/form-data">
          
          <input type="hidden" name="id_categorias" <?php if(isset($_REQUEST['editar'])){echo "value='".$regular['id_categorias']."' readonly disabled";} ?>>
          <br/>
		<br/>
          <input type="text" name="nombre" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['nombre']."' ";}?>placeholder="Nombre" size="100">
             <br/>
		<br/>
           <input type="text" name="definicion" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['definicion']."' ";}?>placeholder="Definicion"size="100">
             <br/>
		<br/>
           <input type="file" name="imagenc" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['imagenc']."' ";}?>><br/><br/>
           <br/>
            <br/>
           <?php 
            if(isset($_REQUEST['editar'])){
               echo"<input type='hidden' name='clave' value='".$regular['id_categorias']."'>";
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