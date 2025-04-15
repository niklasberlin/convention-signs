<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group header
 * @group footer
 * @group page
 * @group pdf
 */

$font = "dejavusans";

// set style for barcode
$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$qr_code_width = 150;

$website = "https://www.ejc2023.org";
$title = "EJC Online Infopoint";


if (isset($_GET['url'])){
	$website = htmlspecialchars($_GET['url']);
}else{
	$website = "website";
}

if (isset($_GET['title'])){
	$title = htmlspecialchars($_GET['title']);
}else{
	$title = "";
}

if (!filter_var($website, FILTER_VALIDATE_URL)) {
    echo("$website is not a valid URL");
	exit;
}

if (isset($_GET['design_color']) && $_GET['design_color']=="black"){
	$design_color = false;
}else{
    $design_color = true;
}

$title = filter_var($title, FILTER_SANITIZE_STRING);

// Include the main TCPDF library (search for installation path).
require_once('EJCPDF.php');

// create new PDF document
$pdf = new EJCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setMyDefaults('QR: '.$title,'QR-Code, EJC');

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage("P");

$pdf->setFont($font, '', 36, '', true);
if($design_color){
    $pdf->SetTextColor(154, 54, 3);
}else{
    $pdf->SetTextColor(0,0,0);
}
$pdf->Cell(0, 0, $title, 0, 1, 'C', 0, '', 0);

// QRCODE,M : QR-CODE Medium error correction

$left = ($pdf->getPageWidth() - $qr_code_width)/2;
$pdf->write2DBarcode($website, 'QRCODE,M', $left, 50, $qr_code_width, $qr_code_width, $style, 'N');

$pdf->setFont($font, '', 18, '', true);

$pdf->cell(0, 0, $website, 0, 1, 'C', 0, '', 0);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output(stristr($website, '.',true).'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
