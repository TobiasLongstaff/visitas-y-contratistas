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

    $pdf = new PDF('P','mm',array(53.98,85.60)); 
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
            $id_trabajadores = $filas['id'];
            $fecha_entrada = $filas['fecha_hora'];
            $fecha_salida = $filas['fecha_salida'];
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

            $pdf->Ln(35);
            $pdf->Cell(15);
            $pdf->Cell (0,0, $nombre_apellido,1,1,'L',1); 
            $pdf->SetFont('Arial','',7);
            $pdf->SetTextColor(95,95,95);
            $pdf->Ln(4);
            $pdf->Cell(15);
            $pdf->Cell (0,0,'Empresa: '.$empresa,1,1,'L',1); 
            $pdf->Ln(4);
            $pdf->Cell(15);
            $pdf->Cell (0,0,'DNI: '.$dni,1,1,'L',1); 
            $pdf->Image($imagen, 17.5, 13.5,'C',24);
            $pdf->Image('assets/img/codeqr/example2.png', 8, 42, 'L', 16);
            $pdf->Ln(9);
            $pdf->Cell (0,0,'Fecha de ingreso: '.$fecha_entrada,1,1,'C',1); 
            $pdf->Ln(3);
            $pdf->Cell (0,0,'Fecha de fin atencion: '.$fecha_salida,1,1,'C',1); 
        }
    }    


    $pdf->Output();
?>