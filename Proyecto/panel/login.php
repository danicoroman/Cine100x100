<?php

if($_SERVER['REQUEST_METHOD']==='POST'){

    $nombre_admin = $_POST['nombre_admin'];
    $clave = $_POST['clave'];

    require '../vendor/autoload.php';
        $usuario = new Cine100x100\Admin;
        $resultado = $usuario->login($nombre_admin, $clave); 

        if($resultado){
            session_start();

            $_SESSION['admin_info'] = array(
                'nombre_admin'=>$resultado['nombre_admin'],
                'estado'=>1
            );

            header('Location: dashboard.php');

        }else{
            exit(json_encode(array('estado'=>false,'mensaje'=>'Error al iniciar sesión')));
        }

}