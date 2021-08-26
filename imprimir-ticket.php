<?php

    include 'imprimir-plantilla-ticket.php';
    require 'partials/conexion.php';
    include 'assets/plugins/phpqrcode/qrlib.php';

    $pdf = new PDF('P','mm',array(100,160)); 
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->Cell(-5);
    $pdf->SetFillColor(999, 999, 999);
    $pdf->SetTextColor(112,112,112);
    $pdf->SetDrawColor(999, 999, 999);
    $pdf->SetFont('Arial','',11);

    if(isset($_GET['id']))
    {
        $id_visita = $_GET['id'];
        $sql="SELECT * FROM ingreso WHERE id = '$id_visita'";
        $resultado = mysqli_query($conexion, $sql);
        if($filas = mysqli_fetch_array($resultado, MYSQLI_ASSOC))
        {
            $nombre_apellido = $filas['nombre_apellido'];
            $dni = $filas['dni'];
            $empresa = $filas['empresa'];
            $sector = $filas['sector_habilitado'];
            $visita = $filas['visita'];
            $fecha_de_ingreso = $filas['fecha_hora'];

            QRcode::png(
                $id_visita,
                "assets/img/codeqr/example1.png",
                QR_ECLEVEL_L,
                5,
                1
            );
            
            $pdf->Ln(22);
            $pdf->Cell(-5);
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell (0,10,'PERSONA VISITADA',1,1,'L',1); 
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(-5);
            $pdf->Cell (0,6,'Visita a: '.$visita,1,1,'L',1);
            $pdf->Cell(-5);
            $pdf->Cell (0,6,'Sector habilitado: '.$sector,1,1,'L',1);
            $pdf->Cell(-5);
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell (0,10,'VISITANTE',1,1,'L',1); 
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(-5);
            $pdf->Cell (0,6,'Nombre y apellido: '.$nombre_apellido,1,1,'L',1); 
            $pdf->Cell(-5);
            $pdf->Cell (0,6,'DNI: '.$dni,1,1,'L',1); 
            $pdf->Cell(-5);
            $pdf->Cell (0,6,'Empresa: '.$empresa,1,1,'L',1);
            $pdf->Ln(6);   
            $pdf->Cell(-5);
            $pdf->Cell (0,6,'Fecha de ingreso: '.$fecha_de_ingreso,1,1,'L',1);
            $pdf->Cell(-5);
            $pdf->Cell (0,6,'Fecha de fin atencion: ___________',1,1,'L',1); 
            $pdf->Cell(-5);
            $pdf->Cell (0,20,'Firma: _________________',1,1,'L',1);  

            $pdf->Image('assets/img/codeqr/example1.png', 30, 115, 40);
        }
    }

    $pdf->Output();
?>