<?php

    session_start();
    require 'conexion_por_planta.php';

    if(isset($_POST['id']))
    {
        $id_empresa = $_POST['id'];
        $sql = "SELECT * FROM empresas WHERE id = '$id_empresa'";
        $json = array();
        $resultado=mysqli_query($conexion,$sql);
        if($filas = mysqli_fetch_array($resultado))
        {
            $json[] = array(
                'nombre' => $filas['nombre'],
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
        mysqli_close($conexion);        
    }
?>