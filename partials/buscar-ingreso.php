<?php

    session_start();
    require 'conexion_por_planta.php';    

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_fin = date('Y-m-d H:i');
    $fecha_fin = str_replace(' ','T', $fecha_fin);

    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        $sql="SELECT * FROM ingreso WHERE id = '$id' AND estado = '1'";
    }
    else
    {
        $sql="SELECT * FROM ingreso WHERE estado = '1'";
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

        // $sql_usuario="SELECT * FROM usuarios WHERE id = '$id_usuario'";
        // $resultado_usuario=mysqli_query($conexion,$sql_usuario);
        // if($filas_usuario = mysqli_fetch_array($resultado_usuario))
        // {
        //     $nombre_usuario = $filas_usuario['nombre_apellido'];
        // }

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
            'fecha_hora' => $filas['fecha_hora'],
            'fecha_salida' => $fecha_fin,
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