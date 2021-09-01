<?php
    session_start();

    require 'conexion_por_planta.php';


    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('Y-m-d H:i:s');

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
        $vehiculo_modelo = $_POST['vehiculo_modelo'];
        $patente = $_POST['patente'];
        $registra_fichada = $_POST['registra_fichada'];
        $fecha_hora = $_POST['fecha_hora'];
        $fecha_de_salida = $_POST['fecha_de_salida'];
        $observacion = $_POST['observacion']; 
        $fecha_art = $_POST['fecha_art'];
        $imagen = $_POST['imagen_perfil'];
        $imagen_art = $_POST['imagen_art'];

        $sql_select="SELECT * FROM trabajadores WHERE dni = '$dni'";
        $resultado_select=mysqli_query($conexion,$sql_select);
        if($filas_select = mysqli_fetch_array($resultado_select))
        {
            $id_trabajador = $filas_select['id_trabajador'];
        }
        else
        {
            $sql_insert = "INSERT INTO trabajadores (nombre_apellido, dni, fecha_de_nacimiento, fecha_art, empresa, imagen, imagen_art) 
            VALUES ('$nombre_apellido', '$dni', '$fecha_de_nacimiento', '$fecha_art', '$empresa', '$imagen', '$imagen_art')";
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
                    $id_trabajador = $filas_select['id'];
                }
            }
        }

        $sql = "INSERT INTO ingreso (temperatura, sector_habilitado, visita, vehiculo_modelo, patente, 
        registra_fichada, fecha_hora, fecha_salida, observacion, id_usuario, id_trabajador, ingreso) VALUES 
        ('$temperatura', '$sector_habilitado', '','$vehiculo_modelo', '$patente', '$registra_fichada', 
        '$fecha_hora', '$fecha_de_salida', '$observacion', '$id_usuario', '$id_trabajador', 'Contratista')";
        $resultado = mysqli_query($conexion, $sql);
        if(!$resultado)
        {
            echo 'error';
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