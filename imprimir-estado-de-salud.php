<?php
    session_start();
    require 'assets/plugins/fpdf/fpdf.php';
    require 'partials/conexion_por_planta.php';

    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('assets/img/EstadoDeSalud1.png', 0, 0, 210);
        }
    }

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('d/m/Y');

    $pdf = new PDF('P','mm',array(210, 320)); 
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFillColor(999, 999, 999);
    $pdf->SetDrawColor(999, 999, 999);
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(8);
    $pdf->Cell(153);
    $pdf->Cell (20,5, $fecha_actual ,1,1,'C',1);

    if(isset($_GET['id']))
    {
        $id_visita = $_GET['id'];
        $sql="SELECT * FROM ingreso WHERE id = '$id_visita'";
        $resultado = mysqli_query($conexion, $sql);
        if($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {
            $sector = $filas['sector_habilitado'];
            $id_trabajadores = $filas['id_trabajador'];
            $sql_trabajador="SELECT * FROM trabajadores WHERE id = '$id_trabajadores'";
            $resultado_trabajador = mysqli_query($conexion, $sql_trabajador);
            if($filas_trabajador= mysqli_fetch_array($resultado_trabajador, MYSQLI_ASSOC))
            {
                $nombre_apellido = $filas_trabajador['nombre_apellido'];
                $dni = $filas_trabajador['dni'];
                $empresa = $filas_trabajador['empresa'];
                $pdf->SetFont('Arial','',8);
                $pdf->Ln(17);
                $pdf->Cell(157);               
                $pdf->Cell (20,4, $fecha_actual ,1,1,'L',1);
                $pdf->Ln(-4);
                $pdf->Cell(82);
                $pdf->Cell (40,4, $nombre_apellido ,1,1,'L',1);
                $pdf->Ln(2);
                $pdf->Cell(82);
                $pdf->Cell (15,4, $dni ,1,1,'L',1);
                $pdf->Ln(2);
                $pdf->Cell(82);
                $pdf->Cell (96,4, $empresa ,1,1,'L',1);
                $pdf->Ln(12);
                $pdf->Cell(82);
                $pdf->Cell (96,4, $sector ,1,1,'L',1);
            }
        }
    }

    $pdf->SetFont('Arial','B',10);
    $pdf->Ln(213.5);
    $pdf->Cell(38);
    $pdf->Cell (20,5, $fecha_actual ,1,1,'C',1);
    $pdf->Ln(-5);
    $pdf->Cell(91);
    $pdf->Cell (20,5, $fecha_actual ,1,1,'C',1);
    $pdf->Ln(-5);
    $pdf->Cell(143);
    $pdf->Cell (20,5, $fecha_actual ,1,1,'C',1);

    $pdf->AddPage();
    $pdf->Image('assets/img/EstadoDeSalud2.png', 0, 0, 210);
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(8.5);
    $pdf->Cell(153);
    $pdf->Cell (20,4, $fecha_actual ,1,1,'L',1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Ln(263);
    $pdf->Cell(38);
    $pdf->Cell (20,5, $fecha_actual ,1,1,'C',1);
    $pdf->Ln(-5);
    $pdf->Cell(91);
    $pdf->Cell (20,5, $fecha_actual ,1,1,'C',1);
    $pdf->Ln(-5);
    $pdf->Cell(143);
    $pdf->Cell (20,5, $fecha_actual ,1,1,'C',1);

    $pdf->Output();
?>