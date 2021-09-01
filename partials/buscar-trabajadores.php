<?php

    session_start();
    require 'conexion_por_planta.php';
    
    if(isset($_POST['dni']) && isset($_SESSION['id_usuario']))
    {
        $dni = $_POST['dni'];

        $sql="SELECT * FROM trabajadores WHERE dni = '$dni'";
        $resultado=mysqli_query($conexion,$sql);
        $json = array();
        if($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'nombre' => $filas['nombre_apellido'],
                'dni' => $filas['dni'],
                'fecha_de_nacimiento' => $filas['fecha_de_nacimiento'],
                'empresa' => $filas['empresa'],
                'fecha_art' => $filas['fecha_art'],
                'imagen' => $filas['imagen'],
                'imagen_art' => $filas['imagen_art'],
            );

            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }
    }
    mysqli_close($conexion);
?>