<?php

    require 'conexion.php';
    session_start();

    if(isset($_POST['nombre_apellido']) && isset($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];
        $nombre_apellido = $_POST['nombre_apellido'];
        $dni = $_POST['dni'];
        $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
        $empresa = $_POST['empresa'];
        $temperatura = $_POST['temperatura'];
        $sector_habilitado = $_POST['sector_habilitado'];
        $vehiculo_modelo = $_POST['vehiculo_modelo'];
        $patente = $_POST['patente'];
        $registra_fichada = $_POST['registra_fichada'];
        $fecha_hora = $_POST['fecha_hora'];
        $observacion = $_POST['observacion']; 
        $imagen = '';

        $sql = "INSERT INTO ingreso_de_contratistas (nombre_apellido, dni, fecha_de_nacimiento, empresa,
        temperatura, sector_habilitado, vehiculo_modelo, patente, registra_fichada, fecha_hora,
        observacion, id_usuario, imagen) VALUES ('$nombre_apellido', '$dni', 
        '$fecha_de_nacimiento', '$empresa', '$temperatura', '$sector_habilitado',
        '$vehiculo_modelo', '$patente', '$registra_fichada', '$fecha_hora', '$observacion', '$id_usuario', '$imagen')";
        $resultado = mysqli_query($conexion, $sql);
        if(!$resultado)
        {
            echo 'error';
        }
        else
        {
            $sql = "SELECT id FROM ingreso_de_contratistas";
            $resultado=mysqli_query($conexion,$sql);
            while($filas = mysqli_fetch_array($resultado))
            {
                $id_ingreso = $filas['id'];
            }
            
            echo $id_ingreso;
        }
    }
    mysqli_close($conexion);
?>