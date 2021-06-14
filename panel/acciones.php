<?php
require '../vendor/autoload.php';

$pelicula = new Cine100x100\Pelicula;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['accion']==='Registrar'){

                if(empty($_POST['titulo']))
                    exit('Completar título');

                if(empty($_POST['sinopsis']))
                    exit('Pon una sinopsis');

                if(!is_numeric($_POST['categoria_id']))
                    exit('Selecciona una categoría');

                if(!is_numeric($_POST['categoria_id']))
                    exit('Selecciona una categoría válida');

                $_params = array(
                    'titulo'=>$_POST['titulo'],
                    'sinopsis'=>$_POST['sinopsis'],
                    'foto'=>subirFoto(),
                    'precio'=>$_POST['precio'],
                    'categoria_id'=>$_POST['categoria_id'],
                    'fecha'=>date('Y-m-d'),
                    'ano_estreno'=>$_POST['ano_estreno'],
                    'director'=>$_POST['director'],
                    'trailer'=>$_POST['trailer']
                );

                $respuesta= $pelicula->registrar($_params);

                if($respuesta){
                    header('Location: peliculas/index.php');
                }
                else
                    print 'Error al registrar la película';
            }
            
            if($_POST['accion']==='Actualizar'){

                if(empty($_POST['titulo']))
                    exit('Completar título');

                if(empty($_POST['sinopsis']))
                    exit('Pon una sinopsis');

                if(!is_numeric($_POST['categoria_id']))
                    exit('Selecciona una categoría');

                if(!is_numeric($_POST['categoria_id']))
                    exit('Selecciona una categoría válida');

                $_params = array(
                    'titulo'=>$_POST['titulo'],
                    'sinopsis'=>$_POST['sinopsis'],
                    'precio'=>$_POST['precio'],
                    'categoria_id'=>$_POST['categoria_id'],
                    'fecha'=>date('Y-m-d'),
                    'ano_estreno'=>$_POST['ano_estreno'],
                    'director'=>$_POST['director'],
                    'trailer'=>$_POST['trailer'],
                    'id' =>$_POST['id'] 
                );

                if(!empty($_POST['foto_temp'])){
                    $_params['foto'] = $_POST['foto_temp'];
                }

                if(!empty($_FILES['foto']['name'])){
                    $_params['foto'] = subirFoto();
                }

                $respuesta= $pelicula->actualizar($_params);
                if($respuesta){
                    header('Location: peliculas/index.php');
                }
                else
                    print 'Error al actualizar la película';
            }
}

            if($_SERVER['REQUEST_METHOD'] === 'GET'){

                $id = $_GET['id'];

                $respuesta= $pelicula->eliminar($id);
                if($respuesta){
                    header('Location: peliculas/index.php');
                }
                else
                    print 'Error al eliminar la película';
            }

        function subirFoto(){
            $carpeta = __DIR__.'/../upload/';

            $archivo = $carpeta.$_FILES['foto']['name'];

            move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);

            return $_FILES['foto']['name'];
        }




?>