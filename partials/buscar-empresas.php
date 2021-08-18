<?php

    require 'conexion.php';

    if(isset($_POST['buscar']))
    {
        $nombre = $_POST['buscar'];

        $sql="SELECT * FROM empresas WHERE nombre LIKE '%".$nombre."%' LIMIT 7";
        $resultado=mysqli_query($conexion,$sql);
        $json = array();
        while($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'id' => $filas['id'],
                'nombre' => $filas['nombre'],
            );
        }
    }
    else
    {
        echo 'error';
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion); 
?>