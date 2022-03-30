<?php

    session_start();
    require 'conexion_por_planta.php';  
    date_default_timezone_set('America/Buenos_Aires');  
    $fecha_actual = date('Y-m-d');

    if(isset($_POST['filtro']) && isset($_POST['tipo']))
    {
        $filtro = $_POST['filtro'];
        $tipo = $_POST['tipo'];

        if($tipo == 'nombre')
        {
            $sql="SELECT ingreso.*, trabajadores.nombre_apellido, trabajadores.dni, 
            trabajadores.fecha_de_nacimiento, trabajadores.empresa, trabajadores.imagen 
            FROM ingreso INNER JOIN trabajadores ON ingreso.id_trabajador = trabajadores.id 
            WHERE estado = '0' AND ingreso = 'Contratista' AND ingreso.fecha_salida >= '$fecha_actual' AND 
            trabajadores.nombre_apellido LIKE '%$filtro%'"; 
        }
        elseif($tipo == 'dni')
        {
            $sql="SELECT ingreso.*, trabajadores.nombre_apellido, trabajadores.dni, 
            trabajadores.fecha_de_nacimiento, trabajadores.empresa, trabajadores.imagen 
            FROM ingreso INNER JOIN trabajadores ON ingreso.id_trabajador = trabajadores.id 
            WHERE estado = '0' AND ingreso = 'Contratista' AND ingreso.fecha_salida >= '$fecha_actual' AND 
            trabajadores.dni LIKE '%$filtro%'"; 
        }
        else
        {
            $sql="SELECT ingreso.*, trabajadores.nombre_apellido, trabajadores.dni, 
            trabajadores.fecha_de_nacimiento, trabajadores.empresa, trabajadores.imagen 
            FROM ingreso INNER JOIN trabajadores ON ingreso.id_trabajador = trabajadores.id 
            WHERE estado = '0' AND ingreso = 'Contratista' AND ingreso.fecha_salida >= '$fecha_actual' AND 
            ingreso.id = '$filtro'"; 
        }
    }
    else
    {
        $sql="SELECT ingreso.*, trabajadores.nombre_apellido, trabajadores.dni, 
        trabajadores.fecha_de_nacimiento, trabajadores.empresa, trabajadores.imagen 
        FROM ingreso INNER JOIN trabajadores ON ingreso.id_trabajador = trabajadores.id 
        WHERE estado = '0' AND ingreso = 'Contratista' AND ingreso.fecha_salida >= '$fecha_actual'"; 
    }

    $resultado=mysqli_query($conexion,$sql);
    $json = array();
    while($filas = mysqli_fetch_array($resultado))
    {
        $img = '';

        $nombre = $filas['nombre_apellido'];
        $dni = $filas['dni'];
        $fecha_de_nacimiento = $filas['fecha_de_nacimiento'];
        $empresa = $filas['empresa'];
        $img = $filas['imagen'];

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