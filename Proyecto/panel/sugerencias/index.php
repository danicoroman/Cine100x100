

<?php
session_start();

if(!isset($_SESSION['admin_info']) OR empty($_SESSION['admin_info']))
{
  header('Location:../index.php');
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
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
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
          <a class="navbar-brand" href="../dashboard.php">Cine100x100</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
          <li class="active">
              <a href="sugerencias/index.php" class="btn">Sugerencias recibidas</a>
            </li>
            <li>
              <a href="../pedidos/index.php" class="btn">Pedidos</a>
            </li>
            <li>
              <a href="../peliculas/index.php" class="btn">Películas</a>
            </li> 
            <li>
          <button class="switch" id="switch">
            <span><i class="fas fa-sun"></i></span>
            <span><i class="fas fa-moon"></i></span>
            </button>
            </li>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['admin_info']['nombre_admin'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../cerrar_sesion.php">Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
      <div class="row">
      </div>
      <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend>Sugerencias enviadas por los usuarios</legend>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Correo</th>
                            <th>Sugerencia</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        
                        $conn = mysqli_connect("localhost", "root", "", "tienda_pelis");
                        $resultado=mysqli_query($conn, "SELECT * FROM sugerencia");
                        if(mysqli_num_rows($resultado) > 0){
                          $i=1;
                        while($row = mysqli_fetch_array($resultado)){
                          
                      ?>

                        <tr>
                          <td><?php print $i++;?></td>
                          <td><?php print $row['nombre']?></td>
                          <td><?php print $row['mail']?></td>
                          <td><?php print $row['mensaje']?></td>
                          <td class="text-center">
                          <a href="borrar.php?id=<?php print $row['id']?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                          </td>
                        </tr>

                        <?php }
                        }
                      
                      else{ ?>
                        <tr>
                          <td colspan="6">NO HAY REGISTROS</td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
      </div>
    
      

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>

  </body>
</html>
