<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require 'funciones.php';
    require '../vendor/autoload.php';

    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        $cliente = new Cine100x100\Cliente;


    $_params = array(
        "nombre" =>$_POST['nombre'],
        "apellidos" =>$_POST['apellidos'],
        "mail" =>$_POST['mail'],
        "telefono" =>$_POST['telefono'],
        "direccion_facturacion" =>$_POST['direccion_facturacion'],
        "numero_tarjeta" =>$_POST['numero_tarjeta'],
        "caducidad" =>$_POST['caducidad'],
        "numero_secreto" =>$_POST['numero_secreto']
    );
    $cliente_id = $cliente->registrar($_params);

    $pedido = new Cine100x100\Pedido;

    $_params = array(
        'cliente_id'=>$cliente_id,
        'total'=>calcularTotal(),
        'fecha'=> date('Y-m-d')
    );

    $pedido_id = $pedido ->registrar($_params);

    foreach($_SESSION['carrito'] as $indice => $value){
        $_params= array(
            "pedido_id" =>$pedido_id,
            "pelicula_id" =>$value['id'],
            "precio" =>$value['precio'],
            "cantidad" =>$value['cantidad']
        );

        $pedido->registrarDetalle($_params);
    }
    $_SESSION['carrito'] = array();

    header('Location: ../gracias.php');

}
}





?>