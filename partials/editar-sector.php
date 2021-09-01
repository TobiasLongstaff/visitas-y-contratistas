<?php

    session_start();
    require 'conexion_por_planta.php';
    

    if(isset($_POST['id']) && isset($_SESSION['id_usuario']))
    {
        $id_sector = $_POST['id']; 
        $nombre = $_POST['nombre'];
        $color = $_POST['color'];

        $sql="UPDATE sector SET nombre = '$nombre', color = '$color' WHERE id = '$id_sector'";
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
        echo '2';
    }
    mysqli_close($conexion);

?>