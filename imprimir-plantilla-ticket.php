<?php

    require 'assets/plugins/fpdf/fpdf.php';
    session_start();

    class PDF extends FPDF
    {
        function Header()
        {
            if($_SESSION['planta_usuario'] == 'Landl')
            {
                $img = 'assets/img/Landl.png';
            }
            else
            {
                $img = 'assets/img/frigopico.png';
            }
            
            $this->Image($img, 26, 10, 40);
            $this->SetFont('Arial','',20);
            $this->Cell(50);
        }
    }
?>