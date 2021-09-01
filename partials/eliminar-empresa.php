<?php

    session_start();
    require 'conexion_por_planta.php';

    if(isset($_POST['id']) && isset($_SESSION['id_usuario']))
    {
        $id_empresa = $_POST['id'];

        $sql_delete = "DELETE FROM empresas WHERE id = '$id_empresa'";
        $resultado_delete = mysqli_query($conexion, $sql_delete);
        if(!$resultado_delete)
        {
            echo 'Error consultar con soporte ';
        }  
        else
        {
            echo '1';
        }      
    }
    mysqli_close($conexion); 
?>