<?php
require_once 'site/tcpdf/tcpdf.php';

class pdf extends TCPDF {
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-30);
        // Set font
        $this->SetFont('helvetica', 'I', 7);
        // Número de página
//        $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
        $this->Cell(0,10,'C.c. Archivo',0,false,'L',0,'',0,false,'T','M');
        $this->Ln(3);
//        $this->Cell(0,10,'Siniestro Nro. '.$this->number,0,false,'L',0,'',0,false,'T','M');
         $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

?>