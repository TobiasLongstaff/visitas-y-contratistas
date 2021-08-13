<?php

    require 'conexion.php';
    session_start();

    if(isset($_POST['id']) && isset($_SESSION['id_usuario']))
    {
        $id_empresa = $_POST['id']; 
        $nombre = $_POST['nombre'];

        $sql="UPDATE empresas SET nombre = '$nombre' WHERE id = '$id_empresa'";
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