<?php

class OfficeController
{
    public function __construct($action)
    {
        self::$action();
    }

    public function pdfGen()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'hi');
        $pdf->Output();
    }

}
