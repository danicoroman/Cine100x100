<?php
  session_start();
  require 'src/funciones.php';
if(!isset($_SESSION['user_info']) OR empty($_SESSION['user_info']))
{
  header('Location:index.php');
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
          <li>
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
            <li><a href="src/cerrar_sesion.php">Cerrar sesión</a></li>
          </ul>
        </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
    <div class="row">
    <?php 
    $servername = "localhost";
    $database = "tienda_pelis";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
			//Paginador
			$sql_registe = mysqli_query($conn,"SELECT COUNT(*) as total_registro FROM peliculas");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 10;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conn,"SELECT id, titulo, foto  FROM peliculas  ORDER BY id ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conn);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
        
         
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h1 class="text-center titulo-pelicula"><?php print $data['titulo'] ?></h1>
                  </div>
                    <div class="panel-body">
                    <?php
                        $foto = 'upload/'.$data['foto'];
                        if(file_exists($foto)){
                      ?>

                        <img src="<?php  print $foto; ?>" class="img-responsive">
                      <?php }else{ ?>

                        <img src="assets/imagenes/not-found.jpg" class="img-responsive">
                      <?php } ?>
                    </div>
                    <div class="panel-footer">
                        <a href="ficha.php?id=<?php print $data['id'] ?>" class="btn btn-success btn-block">
                          <span class="glyphicon glyphicon-eye-open"></span>Ver detalles
                        </a>
                    </div>
                </div>
              </div>
          <?php } 
          }
          ?>
          
              
        
        </div>
      

    </div> <!-- /container -->
    <div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

  </body>
</html>