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
        // $registra_fichada = $_POST['registra_fichada'];
        $fecha_hora = $_POST['fecha_hora'];
        $fecha_de_salida = $_POST['fecha_de_salida'];
        $observacion = $_POST['observacion']; 
        $fecha_art = $_POST['fecha_art'];
        $imagen = $_POST['imagen_perfil'];
        $imagen_art = $_POST['imagen_art'];

        if($fecha_art == '')
        {
            $fecha_art = '0000-01-01';
        }

        $sql_select="SELECT * FROM trabajadores WHERE dni = '$dni'";
        $resultado_select=mysqli_query($conexion,$sql_select);
        if($filas_select = mysqli_fetch_array($resultado_select))
        {
            $id_trabajador = $filas_select['id'];

            $sql_tra_veri="SELECT id FROM ingreso WHERE id_trabajador = '$id_trabajador' AND estado = '1'";
            $resultado_tra_veri = mysqli_query($conexion, $sql_tra_veri);
            $numero_fila_tra_veri = mysqli_num_rows($resultado_tra_veri);
            if($numero_fila_tra_veri >= '1')
            {
                echo 'error0';
            }
            else
            {
                $sql="UPDATE trabajadores SET nombre_apellido = '$nombre_apellido', fecha_de_nacimiento = '$fecha_de_nacimiento',
                dni = '$dni', fecha_art = '$fecha_art', empresa = '$empresa', imagen = '$imagen', imagen_art = '$imagen_art' WHERE id = '$id_trabajador'";
                $resultado = mysqli_query($conexion,$sql);
                if(!$resultado)
                {
                    echo 'error1';
                }
            }
        }
        else
        {
            $sql_insert = "INSERT INTO trabajadores (nombre_apellido, dni, fecha_de_nacimiento, fecha_art, empresa, imagen, imagen_art) 
            VALUES ('$nombre_apellido', '$dni', '$fecha_de_nacimiento', '$fecha_art', '$empresa', '$imagen', '$imagen_art')";
            $resultado_insert = mysqli_query($conexion, $sql_insert);
            if(!$resultado_insert)
            {
                echo 'error2';
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

        $sql_tra_veri="SELECT id FROM ingreso WHERE id_trabajador = '$id_trabajador' AND fecha_salida >= '$fecha_actual'";
        $resultado_tra_veri = mysqli_query($conexion, $sql_tra_veri);
        $numero_fila_tra_veri = mysqli_num_rows($resultado_tra_veri);
        if($numero_fila_tra_veri >= '1')
        {
            echo 'error5';
        }
        else
        {
            $sql = "INSERT INTO ingreso (temperatura, sector_habilitado, visita, vehiculo_modelo, patente, 
            registra_fichada, fecha_hora, fecha_salida, observacion, id_usuario, id_trabajador, ingreso, estado) VALUES 
            ('$temperatura', '$sector_habilitado', '','$vehiculo_modelo', '$patente', '',
            '$fecha_hora', '$fecha_de_salida', '$observacion', '$id_usuario', '$id_trabajador', 'Contratista', '1')";
            $resultado = mysqli_query($conexion, $sql);
            if(!$resultado)
            {
                echo 'error3';
            }
            else
            {
                $sql = "SELECT id FROM ingreso ORDER BY id DESC LIMIT 1";
                $resultado=mysqli_query($conexion,$sql);
                if($filas = mysqli_fetch_array($resultado))
                {
                    $id_ingreso = $filas['id'];
                }
                
                $sql_insert = "INSERT INTO reingreso_contratistas (id_ingreso, fecha_movimiento, tipo) 
                VALUES ('$id_ingreso', '$fecha_actual', 'Ingreso')";
                $resultado_insert = mysqli_query($conexion, $sql_insert);
                if(!$resultado_insert)
                {
                    echo 'error4 ';
                }

                echo $id_ingreso;
            }            
        }
    }
    mysqli_close($conexion);
?>