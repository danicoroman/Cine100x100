<?php

if($_SERVER['REQUEST_METHOD']==='POST'){

    $username = $_POST['username'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $salt="dani";
    $pass_encrypt = sha1($pass.$salt);

    require '../vendor/autoload.php';
        $usuario = new Cine100x100\Usuario;
        $resultado = $usuario->login($username,$mail, $pass_encrypt); 

        if($resultado){
            session_start();

            $_SESSION['user_info'] = array(
                'username'=>$resultado['username'],
                'estado'=>1
            );

            header('Location: ../home.php');

        }else{
            exit(json_encode(array('estado'=>false,'mensaje'=>'Error al iniciar sesión')));
        }

}