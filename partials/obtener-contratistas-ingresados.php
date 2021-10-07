<?php

    session_start();
    require 'conexion_por_planta.php';  
    date_default_timezone_set('America/Buenos_Aires');  
    $fecha_actual = date('Y-m-d');

    $sql="SELECT * FROM ingreso WHERE estado = '0' AND ingreso = 'Contratista' AND fecha_salida >= '$fecha_actual'";
    $resultado=mysqli_query($conexion,$sql);
    $json = array();
    while($filas = mysqli_fetch_array($resultado))
    {
        $nombre = '';
        $dni = '';
        $fecha_de_nacimiento = '';
        $empresa = '';
        $img = '';
        $id_trabajadores = $filas['id_trabajador'];

        $sql_trabajadores="SELECT * FROM trabajadores WHERE id = '$id_trabajadores'";
        $resultado_trabajadores=mysqli_query($conexion,$sql_trabajadores);
        if($filas_trabajadores = mysqli_fetch_array($resultado_trabajadores))
        {
            $nombre = $filas_trabajadores['nombre_apellido'];
            $dni = $filas_trabajadores['dni'];
            $fecha_de_nacimiento = $filas_trabajadores['fecha_de_nacimiento'];
            $empresa = $filas_trabajadores['empresa'];
            $img = $filas_trabajadores['imagen'];
        }

        $json[] = array(
            'id' => $filas['id'],
            'nombre' => $nombre,
            'dni' => $dni,
            'fecha_de_nacimiento' => $fecha_de_nacimiento,
            'empresa' => $empresa,
            'temperatura' => $filas['temperatura'],
            'sector_habilitado' => $filas['sector_habilitado'],
            'visita' => $filas['visita'],
            'vehiculo_modelo' => $filas['vehiculo_modelo'],
            'patente' => $filas['patente'],
            'registra_fichada' => $filas['registra_fichada'],
            'fecha_hora' => $filas['fecha_hora'],
            'fecha_salida' => $filas['fecha_salida'],
            'observacion' => $filas['observacion'],
            'imagen' => $img,
            'ingreso' => $filas['ingreso'],
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);

?>