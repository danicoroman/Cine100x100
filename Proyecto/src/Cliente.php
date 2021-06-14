<?php 
namespace Cine100x100; 


class Cliente{

        private $config;
        private $cn = null;

        public function __construct(){

                $this->config = parse_ini_file(__DIR__.'/../config.ini');
               
                $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8'
                ));

        }
    
    public function registrar($_params){
        $sql = "INSERT INTO `clientes`( `nombre`, `apellidos`, `mail`, `telefono`, `direccion_facturacion`, `numero_tarjeta`, `caducidad`) VALUES (:nombre, :apellidos, :mail, :telefono, :direccion_facturacion, :numero_tarjeta, :caducidad)";

        $resultado = $this->cn->prepare($sql);

        $array= array(
            ":nombre" =>$_params['nombre'],
            ":apellidos" =>$_params['apellidos'],
            ":mail" =>$_params['mail'],
            ":telefono" =>$_params['telefono'],
            ":direccion_facturacion" =>$_params['direccion_facturacion'],
            ":numero_tarjeta" =>$_params['numero_tarjeta'],
            ":caducidad" =>$_params['caducidad']
        );

        if($resultado->execute($array)){
            return $this->cn->lastInsertId();
    }

        return false;
    }
}
    ?>