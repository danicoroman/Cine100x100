<?php
    namespace Cine100x100; 


    class Usuario{
    
            private $config;
            private $cn = null;
    
            public function __construct(){
    
                    $this->config = parse_ini_file(__DIR__.'/../config.ini');
                   
                    $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
                        \PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8'
                    ));
    
            }
            public function login($username, $mail, $pass){
                $sql = "SELECT username FROM usuarios WHERE username = :username AND pass = :pass AND mail = :mail";
                $resultado = $this->cn->prepare($sql);

                $_array = array(
                   ':username'=> $username,
                   ':pass'=> $pass,
                   ':mail'=>$mail
                );
              

                if($resultado->execute($_array)){
                     return $resultado->fetch();
                }

            return false;
    }
    public function registro($username,$mail, $pass){
        
        $sql = "INSERT INTO `usuarios`( `username`, `mail`, `pass`) VALUES (:username,:mail,:pass)";
                $resultado = $this->cn->prepare($sql);

                $array= array(
                    ":username" =>$username,
                    ":mail" =>$mail,
                    ":pass" =>$pass
                );

                if($resultado->execute($array)){
                    header('Location:../home.php');
                }

                return false;
            }
        
    
}



?>