<?php
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
        $this->Cell(30, 10, 'User Report', 0, 2, 'C');

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
$user = new ManageUserContr();
// Add new pages
$pdf->AddPage();


$pdf->SetFont('times', 'B', 12);
$pdf->Cell(40, 12, 'Name', 1);
$pdf->Cell(47, 12, 'Address', 1);
$pdf->Cell(23, 12, 'Role', 1);
$pdf->Cell(60, 12, 'Email', 1);
$pdf->Cell(27, 12, 'Phone', 1);
$pdf->Ln();

$row = $user->viewsUsers('owner', 'customer', 0, 10);
foreach ($row as $rw) {
    $name = $rw['first_name'] . " " . $rw['last_name'];
    $address = $rw['address'];
    $type = $rw['user_type'];
    $email = $rw['email'];
    $mobile = $rw['mobile'];
    $date = date('d/m/Y', strtotime($rw['regdate']));

    // Set font-family and font-size.
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(40, 12, $name, 1);
    $pdf->Cell(47, 12, $address, 1);
    $pdf->Cell(23, 12, $type, 1);
    $pdf->Cell(60, 12, $email, 1);
    $pdf->Cell(27, 12, $mobile, 1);
    $pdf->Ln();
}

$pdf->Output();
