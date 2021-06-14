<?php

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $conn = mysqli_connect("localhost", "root", "", "tienda_pelis");
    $resultado=mysqli_query($conn, "DELETE FROM `sugerencia` WHERE `id` =".$id);
    if($resultado){
        header('Location: index.php');
    }
    else
        print 'Error al eliminar la sugerencia';
}


?>