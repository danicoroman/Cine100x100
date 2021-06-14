<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "tienda_pelis");

if (isset($_POST["submit"])){

    $nombre = $_POST["nombre"];
    $email = $_POST["mail"];
    $sugerencia = $_POST["sugerencia"];
    $resultado=mysqli_query($conn, "INSERT INTO `sugerencia`(`nombre`, `mail`, `mensaje`) VALUES ('$nombre','$email','$sugerencia')");
} else {

    echo '<p>Por favor, complete el <a href="../sugerencia.php">formulario</a></p>';
    }
    if($resultado){
        echo'<script type="text/javascript">
    window.location.href="../home.php";
    alert("Sugerencia enviada con éxito");
    </script>';

    }
    




?>