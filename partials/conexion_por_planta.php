<?php

    if($_SESSION['planta_usuario'] == 'Landl')
    {
        $conexion = mysqli_connect('localhost', 'root', '', 'visitas_y_contratistas_landl');
        if (mysqli_connect_errno())
        {
            $_SESSION['message-error'] = 'Error al conectar la base de datos';
            exit();
        }
        mysqli_select_db($conexion, 'visitas_y_contratistas_landl') or die ($_SESSION['message-error'] = 'Error al conectar');
        mysqli_set_charset($conexion, 'utf8');
    }
    elseif($_SESSION['planta_usuario'] == 'FrigoPico')
    {
        $conexion = mysqli_connect('localhost', 'root', '', 'visitas_y_contratistas_frigopico');
        if (mysqli_connect_errno())
        {
            $_SESSION['message-error'] = 'Error al conectar la base de datos';
            exit();
        }
        mysqli_select_db($conexion, 'visitas_y_contratistas_frigopico') or die ($_SESSION['message-error'] = 'Error al conectar');
        mysqli_set_charset($conexion, 'utf8');
    }

?>