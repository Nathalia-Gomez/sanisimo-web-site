<?php

session_start();
$varsesion=$_SESSION['usuario'];
if($varsesion==null || $varsesion= ''){
    echo 'Usted no tiene autorización no es personal autorizado';
    die();
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
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p>BIENVENIDO: <?php echo $_SESSION['nombreap'];?></p>
            <br>
            <br>
            <h4>Sistema de control principal de la página Web</h4>
            <br>
            <p>Contacto del sistema al 54 4746-9720 o al mail soporte@gruposanisimo.com</p>
            <br>
            <br>
            <img src="img/personaa.png" alt="persona amable">
            </div>
            </div>
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
    </section>
    
</body>
</html>