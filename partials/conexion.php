<?php

    $conexion = mysqli_connect('localhost', 'root', '', 'visitas_y_contratistas');
    if (mysqli_connect_errno())
    {
        $_SESSION['message-error'] = 'Error al conectar la base de datos';
        exit();
    }
    mysqli_select_db($conexion, 'visitas_y_contratistas') or die ($_SESSION['message-error'] = 'Error al conectar');
    mysqli_set_charset($conexion, 'utf8');
?>