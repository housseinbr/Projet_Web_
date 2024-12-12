<?php
require("fpdp/fpdf.php");
include "../../controller/ProduitC.php";

$ProduitC = new ProduitC();
$listeProduits = $ProduitC->listProduit();

class mypdf extends FPDF
{
    function header()
    {
        $this->Image('fpdp/logo2.jpg', 10, 6, 20, 25); 
 
        $this->SetTextColor(30, 144, 255);
        $this->SetFont('Arial', 'B', 25);
        $this->Cell(285, 5, 'Liste des Produits', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 20);
        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new mypdf('P', 'mm', 'A4');
$title = 'Liste des Produits';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->Ln();
$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(20, 10, 'ID', 1, 0, 'C');
$pdf->Cell(30, 10, 'Image', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nom', 1, 0, 'C');
$pdf->Cell(80, 10, 'Description', 1, 0, 'C');
$pdf->Cell(40, 10, 'Categorie', 1, 0, 'C');
$pdf->Cell(30, 10, 'Prix', 1, 0, 'C');
$pdf->Cell(30, 10, 'Disponibilite', 1, 0, 'C');

foreach ($listeProduits as $produit) {
    $pdf->Ln();
    $pdf->Cell(20, 20, htmlspecialchars($produit['idProduit'], ENT_QUOTES), 1, 0, 'C');
    
    $imagePath = '../../images/' . htmlspecialchars($produit['image'], ENT_QUOTES);
    if (file_exists($imagePath)) {
        $pdf->Cell(30, 20, $pdf->Image($imagePath, $pdf->GetX() + 3, $pdf->GetY() + 3, 15, 15), 1, 0, 'C');
    } else {
        $pdf->Cell(30, 20, 'No Image', 1, 0, 'C');
    }
    
    $pdf->Cell(40, 20, htmlspecialchars($produit['nom'], ENT_QUOTES), 1, 0, 'C');
    $pdf->Cell(80, 20, htmlspecialchars($produit['description'], ENT_QUOTES), 1, 0, 'C');
    $pdf->Cell(40, 20, htmlspecialchars($produit['categorie'], ENT_QUOTES), 1, 0, 'C');
    $pdf->Cell(30, 20, htmlspecialchars($produit['prix'], ENT_QUOTES) . " $", 1, 0, 'C');
    
    if ($produit['dispo'] == "Disponible") {
        $pdf->Cell(30, 20, 'Disponible', 1, 0, 'C');
    } else {
        $pdf->Cell(30, 20, 'Hors Stock', 1, 0, 'C');
    }
}

$pdf->Output();
?>