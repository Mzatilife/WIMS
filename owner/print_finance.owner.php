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
        $this->Cell(30, 10, 'Financial Report', 0, 2, 'C');

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
$pdf->Cell(45, 12, 'Warehouse', 1);
$pdf->Cell(40, 12, 'Customer', 1);
$pdf->Cell(25, 12, 'Capacity', 1);
$pdf->Cell(25, 12, 'Commission', 1);
$pdf->Cell(25, 12, 'Owner Fee', 1);
$pdf->Cell(30, 12, 'Date', 1);
$pdf->Ln();

//creating an object to access user data from the "manageusercontr.php" class -------------------->
$user = new ManageUserContr();
$payment = new PaymentContr();
$row = $payment->viewLandlordFinances($user_id, 0, 1000000);
foreach ($row as $rw) {
    $owner = "K" . number_format($rw['owner_fee']);
    $commission = "K" . number_format($rw['commission']);
    $name = $rw['name']." Warehouse";
    $cus_name = $rw['owner_name'];
    $ren_cap = number_format($rw['ren_capacity'])." m2";
    $date = date('d/m/Y', strtotime($rw['rental_date']));

    // Set font-family and font-size.
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(45, 12, $name, 1);
    $pdf->Cell(40, 12, $cus_name, 1);
    $pdf->Cell(25, 12, $ren_cap, 1);
    $pdf->Cell(25, 12, $commission, 1);
    $pdf->Cell(25, 12, $owner, 1);
    $pdf->Cell(30, 12, $date, 1);
    $pdf->Ln();
}

$pdf->Output();
