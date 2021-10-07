<?php

    session_start();
    require 'conexion_por_planta.php';

    if(isset($_POST['nombre']))
    {
        $nombre = $_POST['nombre'];

        $sql="SELECT ingreso.id AS id_ingreso, ingreso.id_trabajador, ingreso.fecha_salida,
        trabajadores.nombre_apellido, trabajadores.id AS id_tabla_trabajador
        FROM ingreso INNER JOIN trabajadores ON ingreso.id_trabajador = trabajadores.id WHERE 
        nombre_apellido LIKE '%".$nombre."%' AND estado = '1' AND ingreso = 'Contratista' LIMIT 7";
        $resultado=mysqli_query($conexion,$sql);
        $json = array();
        while($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'id' => $filas['id_ingreso'],
                'nombre' => $filas['nombre_apellido'],
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