<?php

    session_start();
    require 'conexion_por_planta.php';

    date_default_timezone_set('America/Buenos_Aires');
    $fecha = date('Y-m-d');

    if(isset($_POST['id']))
    {
        $id = $_POST['id']; 

        $sql="UPDATE ingreso SET estado = '0' WHERE id = '$id' AND ingreso = 'Contratista'";
        $resultado = mysqli_query($conexion,$sql);
        if(!$resultado)
        {
            echo '2';    
        }
        else
        {
            echo '1';
        }
    }
    else
    {
        echo '3';
    }
    mysqli_close($conexion);
?>