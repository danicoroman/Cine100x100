<?php
  session_start();
  require 'src/funciones.php';

if(!isset($_SESSION['user_info']) OR empty($_SESSION['user_info']))
{
  header('Location:index.php');
}
$servername = "localhost";
$database = "tienda_pelis";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database); 
 
if(isset($_POST['filtro'])){
  switch($_POST['filtro']){
    case "todos":
      $sql = "select * from peliculas;";
      break;
  case "biografica":
  $sql = "select * from peliculas where categoria_id = 1;";
  break;
  case "accion":
    $sql = "select * from peliculas where categoria_id = 2;";
  break;
  case "ciencia ficción":
    $sql = "select * from peliculas where categoria_id = 3;";
  break;
  case "comedia":
    $sql = "select * from peliculas where categoria_id = 4;";
  break;
  case "drama":
    $sql = "select * from peliculas where categoria_id = 5;";
  break;
  case "musical":
    $sql = "select * from peliculas where categoria_id = 6;";
  break;
  case "romance":
    $sql = "select * from peliculas where categoria_id = 7;";
  break;
  case "terror":
    $sql = "select * from peliculas where categoria_id = 8;";
  break;
  case "independiente":
    $sql = "select * from peliculas where categoria_id = 9;";
  break;
  case "clasica":
    $sql = "select * from peliculas where categoria_id = 10;";
  break;
  case "premiada":
    $sql = "select * from peliculas where categoria_id = 11;";
  break;
  case "infantil":
    $sql = "select * from peliculas where categoria_id = 12;";
  break;
  case "animada":
    $sql = "select * from peliculas where categoria_id = 13;";
  break;
  
  }
  }else{
  $sql = "select * from peliculas;";
  }
  
  
  
  
  
  
  
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
          <li class="dropdown">
          </li>
          <li class="active">
            <a href="filtros.php" class="btn">Filtro de películas</a>
          </li>
          <li>
            <a href="buscar.php" class="btn">Búsqueda de películas</a>
          </li>
          <li>
            <a href="sugerencia.php" class="btn">Contáctanos</a>
          </li>
          <li>
          <button class="switch" id="switch">
            <span><i class="fas fa-sun"></i></span>
            <span><i class="fas fa-moon"></i></span>
            </button>
            </li>
            <li>
              <a href="carrito.php" class="btn">CARRITO <span class="badge"><?php print cantidadPelicula();?></span></a>
            </li>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['user_info']['username'] ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
          </ul>
        </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
    <div class="row">
    <div class="col-md-12">
    <div id="filtros">
                  <p class="lead"> Filtra según tu género favorito para encontrar la mejor película para tí</p>
                  <form action="filtros.php" method="post">
                  <select name="filtro" class="form-select" aria-label="Default select example">
                    <option value="todos"></option>
                    <option value="biografica">Películas biográficas</option>
                    <option value="accion">Películas de Acción</option>
                    <option value="ciencia ficción">Películas de Ciencia Ficción</option>
                    <option value="comedia">Películas de Comedia</option>
                    <option value="drama">Películas Dramáticas</option>
                    <option value="musical">Películas Musicales</option>
                    <option value="romance">Películas Románticas</option>
                    <option value="terror">Películas de Terror</option>
                    <option value="independiente">Películas Independientes</option>
                    <option value="clasica">Grandes Clásicos</option>
                    <option value="premiada">Películas Premiadas</option>
                    <option value="infantil">Películas Infantiles</option>
                    <option value="animada">Películas de Animación</option>
                    </select> <button type="submit" class="btn btn-default">Filtrar</button></form>
        </div>
      </div>
    </div>
          <div class="row">
          
          
	<?php
		$result = mysqli_query($conn,$sql);
		

		while($row = mysqli_fetch_array($result))
		{?>
     <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="text-center titulo-pelicula"><?php print $row['titulo'] ?></h1>
          <div class="text-center precio"><?php print $row['precio']?> €</div>
        </div>
          <div class="panel-body">
          <?php
              $foto = 'upload/'.$row['foto'];
              if(file_exists($foto)){
            ?>

              <img src="<?php  print $foto; ?>" class="img-responsive">
            <?php }else{ ?>

              <img src="assets/imagenes/not-found.jpg" class="img-responsive">
            <?php } ?>
          
          <div class="panel-footer">
              <a href="ficha.php?id=<?php print $row['id'] ?>" class="btn btn-success btn-block">
                <span class="glyphicon glyphicon-eye-open"></span>Ver detalles
              </a>
          </div>
        </div>
      </div>
    </div>
          
     
 
    



          
      
		<?php
    }
    
		
	?>
       
      
      


        

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

  </body>
</html>