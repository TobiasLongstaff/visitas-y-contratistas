<?php

    session_start();
    require 'conexion_por_planta.php';

    date_default_timezone_set('America/Buenos_Aires');
    $fecha = date('Y-m-d H:i');
    $fecha = str_replace(' ','T', $fecha);

    if(isset($_POST['id']))
    {
        $id = $_POST['id']; 

        $sql="UPDATE ingreso SET estado = '1' WHERE id = '$id' AND ingreso = 'Contratista'";
        $resultado = mysqli_query($conexion,$sql);
        if(!$resultado)
        {
            echo '2';    
        }
        else
        {
            echo '1';
        }

        $sql_insert = "INSERT INTO reingreso_contratistas (id_ingreso, fecha_movimiento) 
        VALUES ('$id', '$fecha')";
        $resultado_insert = mysqli_query($conexion, $sql_insert);
        if(!$resultado_insert)
        {
            echo 'error';
        }
    }
    else
    {
        echo '3';
    }
    mysqli_close($conexion);
?>