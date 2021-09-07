<?php

    session_start();
    require 'conexion_por_planta.php';
    
    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('Y-m-d H:i');
    $fecha_actual = str_replace(' ','T', $fecha_actual);

    if(isset($_POST['nombre_apellido']) && isset($_SESSION['id_usuario']))
    {
        $id_trabajador = '';
        $id_usuario = $_SESSION['id_usuario'];
        $nombre_apellido = $_POST['nombre_apellido'];
        $dni = $_POST['dni'];
        $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
        $empresa = $_POST['empresa'];
        $temperatura = $_POST['temperatura'];
        $sector_habilitado = $_POST['sector_habilitado'];
        $visita = $_POST['visita_a'];
        $vehiculo_modelo = $_POST['vehiculo_modelo'];
        $patente = $_POST['patente'];
        $registra_fichada = $_POST['registra_fichada'];
        $fecha_hora = $_POST['fecha_hora'];
        $observacion = $_POST['observacion']; 
        $imagen = $_POST['imagen_perfil'];

        $sql_select="SELECT * FROM trabajadores WHERE dni = '$dni'";
        $resultado_select=mysqli_query($conexion,$sql_select);
        if($filas_select = mysqli_fetch_array($resultado_select))
        {
            $id_trabajador = $filas_select['id'];
        }
        else
        {
            $sql_insert = "INSERT INTO trabajadores (nombre_apellido, dni, fecha_de_nacimiento, fecha_art, empresa, imagen_art, imagen) 
            VALUES ('$nombre_apellido', '$dni', '$fecha_de_nacimiento', '$fecha_de_nacimiento', '$empresa', '', '$imagen')";
            $resultado_insert = mysqli_query($conexion, $sql_insert);
            if(!$resultado_insert)
            {
                echo 'error';
            }
            else
            {
                $sql_select="SELECT * FROM trabajadores WHERE dni = '$dni'";
                $resultado_select=mysqli_query($conexion,$sql_select);
                if($filas_select = mysqli_fetch_array($resultado_select))
                {
                    echo $id_trabajador = $filas_select['id'];
                }
            }
        }

        $sql = "INSERT INTO ingreso (temperatura, sector_habilitado, visita, vehiculo_modelo, patente, 
        registra_fichada, fecha_hora, fecha_salida, observacion, id_usuario, id_trabajador, ingreso) VALUES 
        ('$temperatura', '$sector_habilitado', '$visita', '$vehiculo_modelo', '$patente', 
        '$registra_fichada', '$fecha_hora', '0000-01-01', '$observacion', '$id_usuario', '$id_trabajador', 'Visita')";
        $resultado = mysqli_query($conexion, $sql);
        if(!$resultado)
        {
            echo 'error1';
        }
        else
        {
            $sql = "SELECT id FROM ingreso";
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