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
          <li class="active">
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
        <div class="form-group">
            <form class="form-search" method="GET" action="" onSubmit="return validarForm(this)">
                <div class="input-group">
                    <input class="form-control form-text"  placeholder="Busca el título que más te guste" type="text" name="palabra" />
                    <input type="submit" value="Buscar" name="buscar" class="btn btn-default buscar">
                </div>
            </form>
        </div>
          <?php
            require 'vendor/autoload.php';
            $pelicula = new Cine100x100\Pelicula;
            $buscar = '';
            if(isset($_GET['buscar']))
            {
                $buscar = $_GET['palabra'];
            }
            
            
            $info_peliculas = $pelicula->buscar($buscar);
            
            $cantidad = count($info_peliculas);
            
            if($cantidad > 0){
              for($i = 0;$i < $cantidad; $i++){
                $item = $info_peliculas[$i];
                

            ?>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h1 class="text-center titulo-pelicula"><?php print $item['titulo'] ?></h1>
                  </div>
                    <div class="panel-body">
                    <?php
                        $foto = 'upload/'.$item['foto'];
                        if(file_exists($foto)){
                      ?>

                        <img src="<?php  print $foto; ?>" class="img-responsive">
                      <?php }else{ ?>

                        <img src="assets/imagenes/not-found.jpg" class="img-responsive">
                      <?php } ?>
                    </div>
                    <div class="panel-footer">
                        <a href="ficha.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block">
                          <span class="glyphicon glyphicon-eye-open"></span>Ver detalles
                        </a>
                    </div>
                </div>
              </div>
          <?php }
              } else{ ?>
          <h4>NO HAY PELÍCULAS</h4>

          <?php } ?>
        
        </div>
      

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
     
<script type="text/javascript">
    function validarForm(formulario) 
    {
        if(formulario.palabra.value.length==0) 
        { //¿Tiene 0 caracteres?
            formulario.palabra.focus();  // Damos el foco al control
            alert('Debes rellenar este campo'); //Mostramos el mensaje
            return false; 
         } //devolvemos el foco  
         return true; //Si ha llegado hasta aquí, es que todo es correcto 
     }   
</script>
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>


  </body>
</html>