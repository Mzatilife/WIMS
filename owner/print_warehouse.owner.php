<?php
include "../includes/session.inc.php";
include("../includes/classautoloader.inc.php");
require('../assets/fpdf/fpdf.php');
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Set font-family and font-size
        $this->SetFont('courier', 'B', 20);

        // $this->Image('../../assets/images/logo.png', 160, 8, 40);
        $this->Cell(200, 8, 'Warehouse Information Management System', 0, 2, 'C');

        // Move to the right
        $this->Cell(80);

        // Set the title of pages.
        $this->Cell(30, 10, 'Warehouse Report', 0, 2, 'C');

        // Break line with given space
        $this->Ln(5);
    }
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);

        // Set font-family and font-size of footer.
        $this->SetFont('Arial', 'I', 8);

        // set page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() .
            '/{nb}', 0, 0, 'C');
    }
}

// Create new object.
$pdf = new PDF();
$pdf->AliasNbPages();
// Add new pages
$pdf->AddPage();


$pdf->SetFont('times', 'B', 12);
$pdf->Cell(23, 12, 'Warehouse', 1);
$pdf->Cell(45, 12, 'Location', 1);
$pdf->Cell(22, 12, 'Status', 1);
$pdf->Cell(22, 12, 'Capacity', 1);
$pdf->Cell(22, 12, 'Available', 1);
$pdf->Cell(22, 12, 'Price', 1);
$pdf->Cell(28, 12, 'Date', 1);
$pdf->Ln();

$property = new ManageWarehouseContr();
$row = $property->viewProperty($user_id, 0, 1, 2, 3, 4, 0, 1000000);
foreach ($row as $rw) {
    if ($rw['status'] == 0) {
        $status = "Pending";
    } elseif ($rw['status'] == 1) {
        $status = "Uploaded";
    } elseif ($rw['status'] == 2) {
        $status = "Rejected";
    } elseif ($rw['status'] == 4) {
        $status = "Fully Booked";
    } else {
        $status = "Invalid";
    }
    $name = $rw['name'];
    $address = $rw['location'] . ", " . $rw['area'];
    $capacity = number_format($rw['capacity']);
    $available = number_format($rw['available']);
    $price = "K" . number_format($rw['price']);
    $date = date('d/m/Y', strtotime($rw['date']));

    // Set font-family and font-size.
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(23, 12, $name, 1);
    $pdf->Cell(45, 12, $address, 1);
    $pdf->Cell(22, 12, $status, 1);
    $pdf->Cell(22, 12, $capacity, 1);
    $pdf->Cell(22, 12, $available, 1);
    $pdf->Cell(22, 12, $price, 1);
    $pdf->Cell(28, 12, $date, 1);
    $pdf->Ln();
}

$pdf->Output();
