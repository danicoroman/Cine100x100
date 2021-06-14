<?php 
namespace Cine100x100; 


class Pelicula{

        private $config;
        private $cn = null;

        public function __construct(){

                $this->config = parse_ini_file(__DIR__.'/../config.ini');
               
                $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8'
                ));

        }

            public function registrar($_params){
                $sql = "INSERT INTO `peliculas`(`titulo`, `sinopsis`, `foto`, `precio`, `categoria_id`, `fecha`,`ano_estreno`, `director`, `trailer`) VALUES (:titulo, :sinopsis, :foto, :precio, :categoria_id, :fecha, :ano_estreno, :director, :trailer)";

                $resultado = $this->cn->prepare($sql);

                $array= array(
                    ":titulo" =>$_params['titulo'],
                    ":sinopsis" =>$_params['sinopsis'],
                    ":foto" =>$_params['foto'],
                    ":precio" =>$_params['precio'],
                    ":categoria_id" =>$_params['categoria_id'],
                    ":fecha" =>$_params['fecha'],
                    ":ano_estreno" =>$_params['ano_estreno'],
                    ":director" =>$_params['director'],
                    ":trailer" =>$_params['trailer']
                );

                if($resultado->execute($array))
                    return true;

                return false;
            }

            public function actualizar($_params){
                $sql = "UPDATE `peliculas` SET `titulo`=:titulo,`sinopsis`=:sinopsis,`foto`=:foto,`precio`=:precio,`categoria_id`=:categoria_id,`fecha`=:fecha, `ano_estreno`=:ano_estreno, `director`=:director, `trailer`=:trailer WHERE `id` =:id";

                $resultado = $this->cn->prepare($sql);

                $array= array(
                    ":titulo" =>$_params['titulo'],
                    ":sinopsis" =>$_params['sinopsis'],
                    ":foto" =>$_params['foto'],
                    ":precio" =>$_params['precio'],
                    ":categoria_id" =>$_params['categoria_id'],
                    ":fecha" =>$_params['fecha'],
                    ":ano_estreno" =>$_params['ano_estreno'],
                    ":director" =>$_params['director'],
                    ":trailer" =>$_params['trailer'],
                    ":id"=> $_params['id']
                );

                if($resultado->execute($array))
                    return true;

                return false;
            }

            public function eliminar($id){
                $sql = "DELETE FROM `peliculas` WHERE `id`=:id";

                $resultado = $this->cn->prepare($sql);

                $array= array(
                    ":id"=> $id
                );

                if($resultado->execute($array))
                    return true;

                return false;
            }

            public function mostrar(){

                $sql = "SELECT peliculas.id, titulo, sinopsis, foto, nombre, precio, fecha,ano_estreno, director, trailer FROM peliculas
                
                INNER JOIN categorias
                ON peliculas.categoria_id = categorias.id ORDER BY peliculas.id DESC
                ";

                $resultado = $this->cn->prepare($sql);

                if($resultado->execute())
                    return $resultado->fetchAll();

                return false;
                
            }
            
            public function mostrarPorId($id){

                $sql = "SELECT * FROM `peliculas` WHERE `id`=:id";

                $resultado = $this->cn->prepare($sql);
                $array = array(
                    ":id" => $id
                );

                if($resultado->execute($array))
                    return $resultado->fetch();

                return false; 
            }

            public function buscar($buscar){

                $sql = "SELECT * FROM peliculas WHERE titulo like '%$buscar%' or precio like '%$buscar%' or ano_estreno like '%$buscar%' or director like '%$buscar%'";

                $resultado = $this->cn->prepare($sql);

                if($resultado->execute())
                    return $resultado->fetchAll();

                return false;
            }

            public function mostrarPorCategoria($id){
                $sql = "SELECT * FROM peliculas WHERE id_categoria= :id_categoria";

                $resultado = $this->cn->prepare($sql);
        
                if($resultado->execute())
                    return $resultado->fetchAll();
                    
                return false;
            }







}


?>