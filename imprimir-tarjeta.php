<?php
    session_start();
    require 'assets/plugins/fpdf/fpdf.php';
    require 'partials/conexion_por_planta.php';
    include 'assets/plugins/phpqrcode/qrlib.php';

    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('assets/img/id-card.png', 0, 0, 55);
        }
    }

    $pdf = new PDF('P','mm',array(53.98,120.60)); 
    $pdf->AliasNbPages();
    $pdf->AddPage();

    if($_SESSION['planta_usuario'] == 'Landl')
    {
        $pdf->Image('assets/img/Landl.png', 5, 1, 19);
    }
    else
    {
        $pdf->Image('assets/img/frigopico.png', 5, 2, 26);
    }

    $pdf->SetFillColor(999, 999, 999);
    $pdf->SetTextColor(102,128,211);
    $pdf->SetDrawColor(999, 999, 999);
    $pdf->SetFont('Arial','B',8.5);

    if(isset($_GET['id']))
    {
        $id_visita = $_GET['id'];
        $sql="SELECT * FROM ingreso WHERE id = '$id_visita'";
        $resultado = mysqli_query($conexion, $sql);
        if($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {
            $id_trabajadores = $filas['id_trabajador'];
            $fecha_entrada = $filas['fecha_hora'];
            $fecha_salida = $filas['fecha_salida'];
            $sector = $filas['sector_habilitado'];
            $observacion = $filas['observacion'];

            $sql_color="SELECT * FROM sector WHERE nombre = '$sector'";
            $resultado_color = mysqli_query($conexion, $sql_color);
            if($filas_color = mysqli_fetch_array($resultado_color, MYSQLI_ASSOC))
            {
                $color = $filas_color['color'];
                list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
    
                $pdf->SetFillColor($r, $g, $b);
                $pdf->SetTextColor(999,999,999);
                $pdf->SetDrawColor($r, $g, $b);   
            }

            $sql_trabajador="SELECT * FROM trabajadores WHERE id = '$id_trabajadores'";
            $resultado_trabajador = mysqli_query($conexion, $sql_trabajador);
            if($filas_trabajador= mysqli_fetch_array($resultado_trabajador, MYSQLI_ASSOC))
            {
                $nombre_apellido = $filas_trabajador['nombre_apellido'];
                $dni = $filas_trabajador['dni'];
                $empresa = $filas_trabajador['empresa'];
                $imagen = $filas_trabajador['imagen'];
            }

            $qr = $id_visita.'@'.$nombre_apellido.'@'.$dni.'@'.$empresa;

            QRcode::png(
                $qr,
                "assets/img/codeqr/example2.png",
                QR_ECLEVEL_L,
                5,
                1
            );

            $pdf->Ln(29);
            $pdf->Cell(-11);
            $pdf->Cell (57,3, $sector,1,1,'C',1);
            $pdf->SetFont('Arial','B',7);
            $pdf->SetFillColor(999, 999, 999);
            $pdf->SetTextColor(102,128,211);
            $pdf->SetDrawColor(999, 999, 999);
            $pdf->Ln(7);
            $pdf->Cell(8);
            if(strlen($nombre_apellido) > 20)
            {
                $nombre_apellido1 = substr($nombre_apellido, 0,20);
                $nombre_apellido2 = substr($nombre_apellido, 20);
                $pdf->Cell (0,0,$nombre_apellido1,1,1,'L',1);
                $pdf->Ln(3);
                $pdf->Cell(8);
                $pdf->Cell (0,0,$nombre_apellido2,1,1,'L',1);
            }
            else
            {
                $pdf->Cell (0,0,$nombre_apellido,1,1,'L',1); 
            }

            $pdf->SetFont('Arial','',5);
            $pdf->SetTextColor(95,95,95);
            $pdf->Ln(3);
            $pdf->Cell(8);
            $pdf->Cell (0,0,'Empresa:',1,1,'L',1); 
            $pdf->Ln(3);
            $pdf->Cell(8);
            if(strlen($empresa) > 30)
            {
                $empresa1 = substr($empresa, 0,30);
                $empresa2 = substr($empresa, 30);
                $pdf->Cell (0,0,$empresa1,1,1,'L',1); 
                $pdf->Ln(3);
                $pdf->Cell(8);
                $pdf->Cell (0,0,$empresa2,1,1,'L',1);
            }
            else
            {
                $pdf->Cell (0,0,$empresa,1,1,'L',1); 
            }
            $pdf->Ln(3);
            $pdf->Cell(8);
            $pdf->Cell (0,0,'DNI: '.$dni,1,1,'L',1); 
            $pdf->Ln(5);
            $pdf->Cell (0,0,'Observacion: '.$observacion,1,1,'C',1); 
            if($imagen != '')
            {
                if($_SESSION['planta_usuario'] == 'Landl')
                {
                    $pdf->Image($imagen, 9, 14,'C',22);
                }
                else
                {
                    $pdf->Image($imagen, 16, 13.5,'C',22);
                }
            }
            else
            {
                $pdf->Image('assets/img/usuario.jpg', 16, 13.5,'C',22);
            }
            $pdf->Image('assets/img/codeqr/example2.png', 2, 47, 'L', 16);
            if(strlen($empresa) > 30)
            {
                $pdf->Ln(2);
            }
            else
            {
                $pdf->Ln(5);
            }
            $pdf->Cell (0,0,'Fecha de ingreso: '.$fecha_entrada,1,1,'C',1); 
            $pdf->Ln(2);
            $pdf->Cell (0,0,'Fecha de fin atencion: '.$fecha_salida,1,1,'C',1); 
        }
    }    


    $pdf->Output();
?>