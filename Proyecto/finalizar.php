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
              <a href="carrito.php" class="btn">CARRITO <span class="badge"><?php print cantidadPelicula();?></span></a>
            </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
        <div class="main-form">
            <div class="row">
                <div class="col-md-12">
                <fieldset>
                    <legend>Completar datos de facturación</legend>
                    <form action="src/completar_pedido.php" method="POST" onsubmit="return checkForm(this);">
                        <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                        <div class="form-group">
                                    <label for="mail">Correo</label>
                                    <input type="email" class="form-control" id="mail" name="mail" required>
                        </div>
                        <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                                    <label for="direccion_facturacion">Dirección de facturación</label>
                                    <input type="text" class="form-control" id="direccion_facturacion" name="direccion_facturacion" required>                                
                        </div>
                        <div class="form-group">
                                    <label for="numero_tarjeta">Número de tarjeta</label>
                                    <input type="text" class="form-control" pattern="[0-9]{16}" id="numero_tarjeta" maxlength="19" name="numero_tarjeta" placeholder="XXXX-XXXX-XXXX-XXXX" required>                                
                        </div>
                        <div class="form-group">
                                    <label for="caducidad">Caducidad</label>
                                    <input type="month" class="form-control" id="caducidad" name="caducidad" value="2021-08" min="2021-06" required>                                
                        </div>
                        <div class="form-group">
                                    <label for="numero_secreto">Número Secreto</label>
                                    <input type="text" class="form-control" pattern="[0-9]{3}" id="numero_secreto" maxlength="3" name="numero_secreto" placeholder="XXX" required>                                
                        </div>
                        <div class="form-group">
                              <label for="privacidad">
                            <input type="checkbox" id="privacidad" name="terms" value="privacy_key" class="privacyBox" require>&nbsp;&nbsp;Acepto la <a target="blank" href="privacidad.php">Política de privacidad</a>
                            </label>
                            </div>
                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    </form>

                </fieldset>  
                </div>
            </div>
        </div> 
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


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