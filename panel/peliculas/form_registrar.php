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
          <li>
              <a href="../sugerencias/index.php" class="btn">Sugerencias recibidas</a>
            </li>
            <li>
              <a href="../pedidos/index.php" class="btn">Pedidos</a>
            </li>
            <li class="active">
              <a href="index.php" class="btn">Películas</a>
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
            <div class="col-md-12">
                <fieldset>
                <legend>Datos de la película</legend>  
                    <form method="POST" action="../acciones.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sinopsis">Sinopsis</label>
                                <textarea class="form-control" name="sinopsis" id="sinopsis" cols="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cate">Categorías</label>
                                <select class="form-control" name="categoria_id" id="cate" required>
                                    <option value="">--SELECCIONE--</option>
                                    <?php
                                        require '../../vendor/autoload.php';
                                        $categoria = new Cine100x100\Categoria;
                
                                        $info_categoria = $categoria->mostrar();
                                        $cantidad = count($info_categoria);

                                        for($i =0 ; $i < $cantidad;$i++){

                                          $item = $info_categoria[$i];

                                          ?>
                                          <option value="<?php print $item['id']?>"><?php print $item['nombre']?></option>



                                          <?php
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input class="form-control" type="file" name="foto" id="foto" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input class="form-control" type="number" name="precio" id="precio" placeholder="0.00" step="any" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                            <div class="form-group">
                                <label for="ano_estreno">Año estreno</label>
                                <input type="number" class="form-control" id="ano_estreno" name="ano_estreno" min="1800" max="2021" required>
                            </div>
                            <div class="form-group">
                                <label for="director">Director</label>
                                <input type="text" class="form-control" id="director" name="director" required>
                            </div>
                            <div class="form-group">
                                <label for="trailer">Inserta aquí el iframe del trailer(dándole a insertar en el video de youtube en compartir)</label>
                                <input type="text" class="form-control" id="trailer" name="trailer" required>
                            </div>
                        </div>
                    </div>
                        
                        
                        <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
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
