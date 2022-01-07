<?php
    session_start();
    require 'assets/plugins/fpdf/fpdf.php';
    require 'partials/conexion_por_planta.php';

    class PDF extends FPDF
    {
        function Header()
        {

        }
    }

    date_default_timezone_set('America/Buenos_Aires');
    $fecha_actual = date('d/m/Y');
    $fecha_actual_sql = date('Y-m-d');

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('LANDSCAPE','a4',90);

    $pdf->SetFont('Arial','B',13);

    $pdf->SetFillColor(999,999,999);
    $pdf->SetTextColor(112,112,112);
    $pdf->Cell(40);
    $pdf->Cell(45,25, '',1,0,'C',1);
    $pdf->Cell(110,25, '',1,0,'C',1);
    $pdf->Cell(40,25, '',1,1,'C',1);
    $pdf->Image('assets/img/Landl.png', 50, 10,'C', 25);
    $pdf->SetFillColor(999, 999, 999);
    $pdf->SetTextColor(000,000,000);
    $pdf->SetDrawColor(999, 999, 999);
    $pdf->Ln(-15);
    $pdf->Cell(140);
    $pdf->Cell(1,0, 'INGRESO Y EGRESO DE PERSONAS',1,1,'C',1);
    $pdf->Ln(6);
    $pdf->Cell(142);
    $pdf->Cell(1,0, 'AJENAS A LA EMPRESA',1,1,'C',1);
    $pdf->Ln(-10);
    $pdf->Cell(195);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(1,0, 'R 4.2 - 02',1,1,'L',1);
    $pdf->Ln(5);
    $pdf->Cell(195);
    $pdf->Cell(1,0, 'Revision 01',1,1,'L',1);
    $pdf->Ln(5);
    $pdf->Cell(195);
    $pdf->Cell(1,0, 'Fecha: '.$fecha_actual,1,1,'L',1);
    $pdf->Ln(5);
    $pdf->Cell(195);
    $pdf->Cell(1,0, 'Pagina: '.$pdf->PageNo().' de {nb}',1,1,'L',1);

    $pdf->SetFillColor(153, 204, 255);
    $pdf->SetDrawColor(000,000,000);
    $pdf->SetFont('Arial','B',8);
    $pdf->Ln(7);
    $pdf->Cell(35,15, 'FECHA', 1,0,'C',1);
    $pdf->Cell(25,15, ' ', 1,0,'C',1);
    $pdf->Cell(50,15, 'NOMBRE Y APELLIDO', 1,0,'C',1);
    $pdf->Cell(30,15, 'D.N.I', 1,0,'C',1);
    $pdf->Cell(40,15, ' ', 1,0,'C',1);
    $pdf->Cell(40,15, ' ', 1,0,'C',1);
    $pdf->Cell(35,15, 'HORA SALIDA', 1,0,'C',1);
    $pdf->Cell(24,15, '', 1,0,'C',1);

    $pdf->Ln(2);
    $pdf->Cell(35.5);
    $pdf->Multicell(20,5, "HORA DE\n INGRESO",0,0,'L',1);
    $pdf->Ln(-9);
    $pdf->Cell(150);
    $pdf->Multicell(21,5, "INSTITUCION/EMPRESA  ",0,0,'L',1);
    $pdf->Ln(-10);
    $pdf->Cell(181);
    $pdf->Multicell(35,3, "MOTIVO DE LA VISITA\n O PERSONA VINCU-\nLADA A LAND L S.A.",0,0,'C',1);
    $pdf->Ln(-10);
    $pdf->Cell(256);
    $pdf->Multicell(20,5, "DOMINIO DE\n VEICULO",0,0,'L',1);

    $pdf->Ln(3);
    $pdf->SetDrawColor(000,000,000);
    $pdf->SetFillColor(999, 999, 999);
    $pdf->SetFont('Arial','',9);

    $sql="SELECT ingreso.id AS id_ingreso, ingreso.temperatura, ingreso.sector_habilitado, 
    ingreso.visita, ingreso.vehiculo_modelo, ingreso.patente, ingreso.fecha_hora, 
    ingreso.fecha_salida AS fecha_salida_final, ingreso.observacion, ingreso.id_usuario, 
    ingreso.id_trabajador, ingreso.ingreso, ingreso.estado, reingreso_contratistas.id AS id 
    ,reingreso_contratistas.id_ingreso AS id_reingreso, reingreso_contratistas.fecha_movimiento 
    FROM ingreso INNER JOIN reingreso_contratistas ON ingreso.id = reingreso_contratistas.id_ingreso 
    WHERE ingreso.fecha_salida != '0000-01-01' AND reingreso_contratistas.fecha_movimiento LIKE '$fecha_actual_sql%'";
    $resultado=mysqli_query($conexion,$sql);
    while($filas = mysqli_fetch_array($resultado))
    {
        $id_trabajadores = $filas['id_trabajador'];
        $fecha_movimiento = $filas['fecha_movimiento'];
        $fehca_hora = explode(' ', $fecha_movimiento);
        $fecha = $fehca_hora[0];
        $hora = $fehca_hora[1];
        $visita = $filas['visita'];
        $fecha_salida = $filas['fecha_salida_final'];
        $patente = $filas['patente'];

        $sql_trabajadores="SELECT * FROM trabajadores WHERE id = '$id_trabajadores'";
        $resultado_trabajadores=mysqli_query($conexion,$sql_trabajadores);
        if($filas_trabajadores = mysqli_fetch_array($resultado_trabajadores))
        {
            $nombre_apellido = $filas_trabajadores['nombre_apellido'];
            $DNI = $filas_trabajadores['dni'];
            $empresa = $filas_trabajadores['empresa'];
            $pdf->Cell(35,6, $fecha,1,0,'C',1);
            $pdf->Cell(25,6, $hora,1,0,'C',1);
            $pdf->Cell(50,6, $nombre_apellido,1,0,'C',1);
            $pdf->Cell(30,6, $DNI,1,0,'C',1);
            if(strlen($empresa) > 20)
            {
                $empresa = str_split($empresa, 20);
                $pdf->Cell(40,6, $empresa[0].'...',1,0,'C',1);
            }
            else
            {
                $pdf->Cell(40,6, $empresa,1,0,'C',1);
            }
            $pdf->Cell(40,6, $visita,1,0,'C',1);
            $pdf->Cell(35,6, $fecha_salida,1,0,'C',1);
            $pdf->Cell(24,6, $patente,1,1,'C',1);
        }
    }
    $pdf->Ln(10);
    $pdf->Cell(70);
    $pdf->SetFillColor(000, 000, 204);
    $pdf->SetDrawColor(000,000,000);
    $pdf->SetTextColor(999,999,999);
    $pdf->Cell(45,6, 'Elaboro', 1,0,'C',1);
    $pdf->Cell(45,6, 'Reviso', 1,0,'C',1);
    $pdf->Cell(45,6, 'Aprobo', 1,1,'C',1);
    $pdf->SetDrawColor(000,000,000);
    $pdf->SetFillColor(999, 999, 999);
    $pdf->SetTextColor(000,000,000);
    $pdf->Cell(70);
    $pdf->Cell(45,6, 'Nadia Torres', 1,0,'C',1);
    $pdf->Cell(45,6, 'Mauricio Mercau', 1,0,'C',1);
    $pdf->Cell(45,6, 'Oscar Prizzon', 1,1,'C',1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(70);
    $pdf->Cell(45,6, 'Fecha: '.$fecha_actual, 1,0,'C',1);
    $pdf->Cell(45,6, 'Fecha: '.$fecha_actual, 1,0,'C',1);
    $pdf->Cell(45,6, 'Fecha: '.$fecha_actual, 1,0,'C',1);

    $pdf->Output();
?>