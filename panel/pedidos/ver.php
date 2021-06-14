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
            <li class="active">
              <a href="index.php" class="btn">Pedidos</a>
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
        <div class="col-md-12">
            <fieldset>
            <?php 
            require '../../vendor/autoload.php';
            $id= $_GET['id'];
            $pedido = new Cine100x100\Pedido;

            $info_pedido = $pedido->mostrarPorId($id);
            $info_detalle_pedido = $pedido->mostrarDetallePorIdPedido($id);
            ?>
                <legend>Información de la compra</legend>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" value="<?php print $info_pedido['nombre']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellidos</label>
                    <input type="text" class="form-control" value="<?php print $info_pedido['apellidos']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="text" class="form-control" value="<?php print $info_pedido['mail']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="text" class="form-control" value="<?php print $info_pedido['fecha']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="dirección">Dirección</label>
                    <input type="text" class="form-control" value="<?php print $info_pedido['direccion_facturacion']?>" readonly>
                </div>
                <hr>
                    Productos Comprados
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Foto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        
                        $cantidad = count($info_detalle_pedido); 

                        if($cantidad > 0){
                          $cont=0;
                          for($i = 0; $i < $cantidad; $i++){
                            $cont++;
                            $item = $info_detalle_pedido[$i];
                            $total = $item['precio'] * $item['cantidad'];
                      ?>

                        <tr>
                          <td><?php print $cont?></td>
                          <td><?php print $item['titulo']?></td>
                          <td>
                          <?php
                                $foto = '../../upload/'.$item['foto'];
                                if(file_exists($foto)){
                            ?>

                                <img src="<?php  print $foto; ?>" width="35">
                          <?php }else{ ?>

                              <p>SIN FOTO</p>
                              <?php } ?>
                          </td>
                          <td><?php print $item['precio']?> €</td>
                          <td><?php print $item['cantidad']?></td>
                          <td><?php print $total?></td>
                        </tr>

                        <?php
                        }
                      
                      }else{ ?>
                        <tr>
                          <td colspan="6">NO HAY REGISTROS</td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="total">Total Compra</label>
                        <input type="text" class="form-control" value="<?php print $info_pedido['total']?>" readonly>
                    </div>
                </div>
            </fieldset>
            <div class="pull-left">
            <a href="index.php" class="btn btn-default hidden-print">Regresar</a>
            </div>
            <div class="pull-right">
            <a href="javascript:;" id="btnImprimir" class="btn btn-danger hidden-print">Imprimir</a>
            </div>
        </div>
      </div>
    
      

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script>
        $('#btnImprimir').on('click', function(){
            window.print();
        })
    
    
    </script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>

  </body>
</html>
