<?php

    session_start();
    require 'conexion_por_planta.php';    

    $sql="SELECT * FROM ingreso WHERE estado = '1'";
    $resultado=mysqli_query($conexion,$sql);
    $json = array();
    while($filas = mysqli_fetch_array($resultado))
    {
        $id = $filas['id'];
        $nombre = '';
        $dni = '';
        $fecha_de_nacimiento = '';
        $empresa = '';
        $img = '';
        $id_trabajadores = $filas['id_trabajador'];
        $ingreso = $filas['ingreso'];

        if($ingreso == 'Contratista')
        {
            $sql_select="SELECT * FROM reingreso_contratistas WHERE id_ingreso = '$id'";
            $resultado_select=mysqli_query($conexion,$sql_select);
            while($filas_select = mysqli_fetch_array($resultado_select))
            {
                $fecha_hora = $filas_select['fecha_movimiento'];
            }
        }
        else
        {
            $fecha_hora = $filas['fecha_hora'];
        }

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
            'id' => $id,
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
            'fecha_hora' => $fecha_hora,
            'fecha_salida' => $filas['fecha_salida'],
            'observacion' => $filas['observacion'],
            'imagen' => $img,
            'ingreso' => $ingreso,
        ); 
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);

?>