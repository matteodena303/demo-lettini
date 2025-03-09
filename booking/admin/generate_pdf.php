<?php
require_once('../class/TCPDF/tcpdf.php'); // Assicurati di avere TCPDF nella tua cartella

// Creazione della classe personalizzata che estende TCPDF
class MYPDF extends TCPDF
{
    public function Header()
    {
        // Intestazione del documento
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 10, 'Mappa Settimanale', 0, 1, 'C');
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(0, 10, 'Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}

// Creazione dell'oggetto PDF
$pdf = new MYPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Mappa Settimanale');
$pdf->SetHeaderData('', 0, 'Mappa Settimanale', 'Generato il ' . date('d-m-Y'));

// Imposta margini
$pdf->SetMargins(10, 25, 10);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->AddPage();

// Recupero dati della tabella da `tabella-settimane.php`
ob_start();
include('tabella-settimane.php');  // Assicurati che questo file generi la tabella in HTML puro
$html = ob_get_clean();

// Aggiunge la tabella al PDF
$pdf->SetFont('helvetica', '', 10);
$pdf->writeHTML($html, true, false, true, false, '');

// Output del PDF
$pdf->Output('mappa_settimanale.pdf', 'D'); // 'D' forza il download
