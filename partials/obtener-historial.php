<?php

    session_start();
    require 'conexion_por_planta.php';    

    $sql_limit = '';
    $filtro = '';

    if(isset($_POST['limite']))
    {
        $limite = $_POST['limite'];
        $sql_limit = "LIMIT $limite";
    }

    if(!empty($_POST['tipo']) && $_POST['tipo'] != 'Todos')
    {
        $tipo = $_POST['tipo'];

        $filtro = "WHERE ingreso.ingreso = '$tipo'";
    }

    if(!empty($_POST['dni']))
    {
        $dni = $_POST['dni'];
        if($filtro != '')
        {
            $filtro = $filtro." AND trabajadores.dni LIKE '%".$dni."%'";
        }
        else
        {
            $filtro = "WHERE trabajadores.dni LIKE '%".$dni."%'";
        }
    }

    if(!empty($_POST['fecha']) && $_POST['fecha'])
    {
        $fecha = $_POST['fecha'];

        if($filtro != '')
        {
            $filtro = $filtro." AND ingreso.fecha_hora LIKE '".$fecha."%'";
        }
        else
        {
            $filtro = "WHERE ingreso.fecha_hora LIKE '".$fecha."%'";
        }
    }

    $sql="SELECT ingreso.id AS id_ingreso, ingreso.temperatura, ingreso.sector_habilitado, 
    ingreso.visita, ingreso.vehiculo_modelo, ingreso.patente, ingreso.fecha_hora, 
    ingreso.fecha_salida AS fecha_salida_final, ingreso.observacion, ingreso.id_usuario, 
    ingreso.id_trabajador, ingreso.ingreso, ingreso.estado, reingreso_contratistas.id AS id, 
    reingreso_contratistas.id_ingreso AS id_reingreso, reingreso_contratistas.fecha_movimiento, 
    trabajadores.nombre_apellido, trabajadores.dni, trabajadores.fecha_de_nacimiento, 
    trabajadores.empresa, trabajadores.imagen FROM ingreso INNER JOIN reingreso_contratistas ON 
    ingreso.id = reingreso_contratistas.id_ingreso INNER JOIN trabajadores ON 
    ingreso.id_trabajador = trabajadores.id $filtro ORDER BY fecha_movimiento DESC ".$sql_limit;
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
        $nombre = $filas['nombre_apellido'];
        $dni = $filas['dni'];
        $fecha_de_nacimiento = $filas['fecha_de_nacimiento'];
        $empresa = $filas['empresa'];
        $img = $filas['imagen'];

        $id = $filas['id'];

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