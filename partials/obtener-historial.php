<?php

    require 'conexion.php';
    session_start();

    $sql="SELECT * FROM ";
    $resultado=mysqli_query($conexion,$sql);
    $json = array();
    while($filas = mysqli_fetch_array($resultado))
    {
        $json[] = array(
            'id' => $filas['id'],
            'nombre' => $filas['nombre'],
            'cont' => $contador
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);

?>