<?php

    session_start();
    require 'conexion_por_planta.php';

    if(isset($_POST['nombre']) && isset($_SESSION['id_usuario']))
    {
        $nombre = $_POST['nombre'];
        $color = $_POST['color'];

        $sql = "INSERT INTO sector (nombre, color) VALUES ('$nombre', '$color')";
        $resultado = mysqli_query($conexion, $sql);
        if(!$resultado)
        {
            echo 'error';
        }
        else
        {
            echo '1';
        }
    }
    mysqli_close($conexion); 

?>