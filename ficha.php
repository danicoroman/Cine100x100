<?php
  session_start();
  require 'src/funciones.php';
if(!isset($_SESSION['user_info']) OR empty($_SESSION['user_info']))
{
  header('Location:index.php');
}
?>

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cine100x100</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Cine100x100</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
          <li>
            <a href="filtros.php" class="btn">Filtro de películas</a>
          </li>
          <li>
            <a href="buscar.php" class="btn">Búsqueda de películas</a>
          </li>
            <li>
              <a href="carrito.php" class="btn">CARRITO <span class="badge"><?php print cantidadPelicula();?></span></a>
            </li>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['user_info']['username'] ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="src/cerrar_sesion.php">Cerrar sesión</a></li>
          </ul>
        </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
    <?php
    $id= $_GET['id'];
       $conn = mysqli_connect("localhost", "root", "", "tienda_pelis");

       $resultado = mysqli_query($conn, "SELECT * FROM peliculas WHERE id = $id");
       while ($row = mysqli_fetch_array($resultado,MYSQLI_ASSOC)){

    
        ?>
        <div class="row">
          <div class="col-md-12">
              <h1 class="text-center ficha-titulo"><?php print $row['titulo'] ?></h1>
          </div>
        </div>
    <div class="row">
        <div class="col-md-12">
        <?php
            $foto = 'upload/'.$row['foto'];
                if(file_exists($foto)){
                      ?>
<div class="caratula"><img src="<?php  print $foto; ?>" class="img-responsive"></div>
                        
                      <?php }else{ ?>

                        <img src="assets/imagenes/not-found.jpg" class="img-responsive">
                      <?php } ?>
                      <br><br>
                      <div class="row datos-peli">
                      <div class="col-md-6 sinopsis-container"><h1 class="sinopsis">Sinopsis</h1>
                    <p class="sinopsisp"><?php print $row['sinopsis'] ?></p></div>

                    <div class="col-md-6">
                        <ul class="datos">
                          <li><b>Año de estreno:</b><?php print $row['ano_estreno'] ?></li>
                          <li><b>Precio:</b><?php print $row['precio'] ?>€ </li>
                          <li><b>Director:</b><?php print $row['director'] ?></li>
                        </ul>

                    </div>
                  </div>
                    <div class="row">
                        <div class="col-md-12 trailer">
                        <div><?php print $row['trailer'] ?></div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 comprar"> <a href="carrito.php?id=<?php print $row['id'] ?>" class="btn btn-success btn-block">
                          <span class="glyphicon glyphicon-shopping-cart"></span>Comprar
                        </a></div>
                    </div>
          
        </div>

    </div>
        
          
<?php } ?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>