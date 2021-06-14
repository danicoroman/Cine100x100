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
          <li class="active">
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
                    
                    <div class="col-3">
                        <h1>Deja aquí tu sugerencia</h1>
                    </div>
                    
                    <div class="col-3">
                      <form action="src/sugerir.php" method="POST" onsubmit="return checkForm(this);">
                       
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input name="nombre" required type="text" id="nombre"
                                    class="form-control" placeholder="Tu nombre">
                            </div>
                            <div class="form-group">
                                <label for="mail">Correo electrónico</label>
                                <input name="mail" required type="email" id="mail"
                                    class="form-control" placeholder="Tu correo electrónico">
                            </div>
                            <div class="form-group">
                                <label for="sugerencia">Sugerencia</label>
                                <textarea required placeholder="Escribe tu mensaje"
                                    class="form-control" name="sugerencia" id="sugerencia"
                                    cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="privacidad">
                            <input type="checkbox" id="privacidad" name="terms" value="privacy_key" class="privacyBox" require>&nbsp;&nbsp;Acepto la <a target="blank" href="privacidad.php">Política de privacidad</a>
                            </label>
                            </div>
                            <div class="form-group">
                            <button name="submit" type="submit" id="btnEnviar" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                      </form>
                    </div>
                    
          </div>
      

    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
  <script>
    function checkForm(form)
  {
    if(!form.terms.checked) {
      alert("Por favor, acepta la política de privacidad");
      form.terms.focus();
      return false;
    }
    return true;
  }
  </script>

    

  </body>
</html>