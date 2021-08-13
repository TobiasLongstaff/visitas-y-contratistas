<?php

    require 'conexion.php';
    session_start();

    if(isset($_POST['id']))
    {
        $id_sector = $_POST['id'];
        $sql = "SELECT * FROM sector WHERE id = '$id_sector'";
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