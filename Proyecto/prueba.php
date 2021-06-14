<?php

$cons_usuario="root";
$cons_contra="";
$cons_base_datos="tienda_pelis";
$cons_equipo="localhost";

$obj_conexion = 
mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);
$var_consulta= "select * from usuarios";
$var_resultado = $obj_conexion->query($var_consulta);
if($var_resultado->num_rows>0)
      {
        echo"<table border='1' align='center'>
         <tr bgcolor='#E6E6E6'>
            <th>Campo1</th>
            <th>Campo2</th>
            <th>Campo3</th>
            <th>Campo5</th>
            <th>Campo5</th>
        </tr>";
    
    while ($var_fila=$var_resultado->fetch_array())
    {
        echo "<tr>
        <td>".$var_fila["id"]."</td>";
        echo "<td>".$var_fila["mail"]."</td>";
        echo "<td>".$var_fila["pass"]."</td></tr>";
     }
    }
print_r ($var_resultado);
?>