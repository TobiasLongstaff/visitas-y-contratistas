<?php

    session_start();
    require 'conexion.php';

    if(isset($_POST['nombre']) && isset($_SESSION['id_usuario']))
    {
        $nombre = $_POST['nombre'];

        $sql = "INSERT INTO sector (nombre) VALUES ('$nombre')";
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