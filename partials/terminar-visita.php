<?php

    session_start();
    require 'conexion_por_planta.php';

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('Y-m-d H:i:s');

    if(isset($_POST['id']))
    {
        $id = $_POST['id']; 

        $sql="UPDATE ingreso SET fecha_salida = '$fecha_actual', estado = '0' WHERE id = '$id' AND ingreso = 'Visita'";
        $resultado = mysqli_query($conexion,$sql);
        if(!$resultado)
        {
            echo '2';    
        }
        else
        {
            echo '1';
            $sql_insert = "INSERT INTO reingreso_contratistas (id_ingreso, fecha_movimiento, tipo) 
            VALUES ('$id', '$fecha_actual', 'Egreso')";
            $resultado_insert = mysqli_query($conexion, $sql_insert);
            if(!$resultado_insert)
            {
                echo 'error';
            }
        }
    }
    else
    {
        echo '3';
    }
    mysqli_close($conexion);

?>