<?php

session_start();
$varsesion=$_SESSION['usuario'];
if($varsesion==null || $varsesion= '')
{
    echo 'Usted no tiene autorización no es personal autorizado';
    die();
}

include 'conexion.php';

$sentencia= "select * from productos";
$resultado=mysqli_query($conexion, $sentencia);
$nfilas=mysqli_num_rows($resultado);


if(isset($_REQUEST['id_productos'])) 
{
    $id_productos=$_REQUEST['id_productos'];
    $nombre=$_REQUEST['nombre'];
    $precio=$_REQUEST['precio'];
    $stock=$_REQUEST['stock'];
    $imagen=$_REQUEST['imagen'];
    $id_categoriass=$_REQUEST['id_categorias'];
    
    $subio=false;
    $directorio='archivos'; 
    $imagen=$directorio."/".$_FILES['imagen']['name'];
    
    if(is_uploaded_file($_FILES['imagen']['tmp_name']))
    {
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
        $subio=true;
        if($subio)
        {
    
    $insertar="insert into productos (nombre, precio, stock, imagen, id_categorias) values ('$nombre', '$precio', '$stock', '$imagen', '$id_categoriass')"; 
            mysqli_query($conexion, $insertar);
            echo"<script>alert('Registro Exitoso')</script>";
            echo"<script>window.location='productos.php</script>";
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
    mysqli_query($conexion, "delete from productos where id_productos=$eliminar");
    echo "<script>alert('Registro Eliminado');</script>";
    echo "<script>window.location='productos.php'</script>";

}

if(isset($_REQUEST['editar']))
{
    $editar=$_REQUEST['editar'];
    $registros=mysqli_query($conexion, "select * from productos where id_productos=$editar");
    $regular=mysqli_fetch_array($registros);
}

if(isset($_REQUEST['clave']))
{
    $id_productos=$_REQUEST['clave'];
    $nombre=$_REQUEST['nombre'];
    $precio=$_REQUEST['precio'];
    $stock=$_REQUEST['stock'];
    $imagen=$_REQUEST['imagen'];
    $id_categoriass=$_REQUEST['id_categorias'];
    
    $subio=false;
    $directorio='archivos';
    $imagen=$directorio."/".$_FILES['imagen']['name'];
    
    if(is_uploaded_file($_FILES['imagen']['tmp_name']))
    {
    move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    $subio=true;
    if($subio)
       { 
        mysqli_query($conexion, "update productos set nombre='$nombre', precio='$precio', stock='$stock', imagen='$imagen', id_categorias='$id_categoriass' where id_productos='$id_productos'");
             echo '<script>alert("Registro Actualizado")</script>';
             echo "<script>window.location='productos.php'</script>";              
       
        }
        else
        {
            echo "<script>alert('Error');</script>";
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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
                           
		<h1>Lista Productos: </h1>
		<br/><br/>
		 <table>
			<tr>
				<td>ID</td>
				<td>Nombre</td>
                <td>Precio</td>
				<td>Stock</td>
				<td>Imagen</td>
				<td>ID Categoria</td>
				<td></td>
				<td></td>
			</tr>
               <?php while($produc=mysqli_fetch_array($resultado)){ ?>
               <tr>
                <td > <?php echo $produc['id_productos'];?></td>
                <td > <?php echo $produc['nombre'];?></td>
               <td > $ <?php echo $produc['precio'];?></td>
               <td > <?php echo $produc['stock'];?></td>
               <td > <img src="<?php echo $produc['imagen']; ?>"> <p><?php echo $produc['imagen'];?></p></td>
               <td > <?php echo $produc['id_categorias'];?></td>
               <td><a onclick="return preguntar()" href="productos.php?eliminar=<?php echo $produc['id_productos'];?>"> Eliminar</a></td>
                <td><a href="productos.php?editar=<?php echo $produc['id_productos'];?>">Editar</a></td>
            </tr>
				<?php } ?>	
		</table>
		<br/>
		<br/>
		<hr>
		<br/>
		<h3>Ingresar Productos:</h3>
       <br/>
		   <form action="productos.php" method="post" enctype="multipart/form-data">
         
          <input type="hidden" name="id_productos" <?php if(isset($_REQUEST['editar'])){echo "value='".$regular['id_productos']."' readonly disabled";} ?>>
          
          <input type="text" name="nombre" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['nombre']."' ";}?>placeholder="Nombre" size="50"><br/><br/>
          
          <input type="text" name="precio" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['precio']."' ";}?>placeholder="Precio" size="50"><br/><br/>
          
          <input type="text" name="stock" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['stock']."' ";}?>placeholder="Stock" size="50"><br/><br/>
          
          <input type="file" name="imagen" <?php if(isset($_REQUEST['editar'])){echo "value= '".$regular['imagen']."' ";}?>><br/><br/>
          
          <select name="id_categorias" id="id_categorias"<?php if(isset($_REQUEST['editar'])){echo "<input type='text' value= '".$regular['id_categorias']."'> ";}?>>
               <option value=1>Granos</option>
               <option value=2>Soya</option>
               <option value=3>Bebidas</option>
           </select>
          
          
           <br/>
            <br/>
           <?php 
            if(isset($_REQUEST['editar'])){
               echo"<input type='hidden' name='clave' value='".$regular['id_productos']."'>";
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