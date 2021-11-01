<?php

    session_start();
    require 'conexion_por_planta.php';    

    if(!empty($_POST['filtrar']) && $_POST['filtrar'] != 'Todos')
    {
        $filtro = $_POST['filtrar'];
        $sql="SELECT ingreso.id AS id_ingreso, ingreso.temperatura, ingreso.sector_habilitado, ingreso.visita, ingreso.vehiculo_modelo, ingreso.patente, ingreso.fecha_hora, ingreso.fecha_salida AS fecha_salida_final, ingreso.observacion, ingreso.id_usuario, ingreso.id_trabajador, ingreso.ingreso, ingreso.estado, reingreso_contratistas.id AS id ,reingreso_contratistas.id_ingreso AS id_reingreso, reingreso_contratistas.fecha_movimiento FROM ingreso INNER JOIN reingreso_contratistas ON ingreso.id = reingreso_contratistas.id_ingreso WHERE ingreso = '$filtro' ORDER BY fecha_movimiento DESC";
    }
    else
    {
        $sql="SELECT ingreso.id AS id_ingreso, ingreso.temperatura, ingreso.sector_habilitado, ingreso.visita, ingreso.vehiculo_modelo, ingreso.patente, ingreso.fecha_hora, ingreso.fecha_salida AS fecha_salida_final, ingreso.observacion, ingreso.id_usuario, ingreso.id_trabajador, ingreso.ingreso, ingreso.estado, reingreso_contratistas.id AS id ,reingreso_contratistas.id_ingreso AS id_reingreso, reingreso_contratistas.fecha_movimiento FROM ingreso INNER JOIN reingreso_contratistas ON ingreso.id = reingreso_contratistas.id_ingreso ORDER BY fecha_movimiento DESC";
    }

    $nombre_usuario = '';
    
    $resultado=mysqli_query($conexion,$sql);
    $json = array();
    while($filas = mysqli_fetch_array($resultado))
    {
        $nombre = '';
        $dni = '';
        $fecha_de_nacimiento = '';
        $empresa = '';
        $img = '';
        $id_usuario = $filas['id_usuario'];
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
            // 'registra_fichada' => $filas['registra_fichada'],
            'fecha_hora' => $filas['fecha_movimiento'],
            'fecha_salida' => $filas['fecha_salida_final'],
            'observacion' => $filas['observacion'],
            'usuario' => $nombre_usuario,
            'imagen' => $img,
            'ingreso' => $filas['ingreso'],
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);

?>