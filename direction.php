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

function map($value, $fromLow, $fromHigh, $toLow, $toHigh) {
    $fromRange = $fromHigh - $fromLow;
    $toRange = $toHigh - $toLow;
    $scaleFactor = $toRange / $fromRange;

    // Re-zero the value within the from range
    $tmpValue = $value - $fromLow;
    // Rescale the value to the to range
    $tmpValue *= $scaleFactor;
    // Re-zero back to the to range
    return $tmpValue + $toLow;
}

$qr_code_width = 150;

$title = "EJC Online Infopoint";


if (isset($_GET['text'])){
	$text = filter_var($_GET['text'],FILTER_SANITIZE_STRING);
    //filter_var($_GET['ssid'],FILTER_SANITIZE_STRING);
}else{
	$text = "";
}

if (isset($_GET['direction'])){
	$direction = filter_var($_GET['direction'],FILTER_SANITIZE_NUMBER_INT);
}else{
	$direction = 0;
}

if (isset($_GET['orientation'])){
	$orientation = filter_var($_GET['orientation'],FILTER_SANITIZE_STRING);
}

if (isset($_GET['logo_visibility']) && $_GET['logo_visibility']=="hidden"){
	$show_logo = false;
}else{
    $show_logo = true;
}

//bg_visibility
if (isset($_GET['bg_visibility']) && $_GET['bg_visibility']=="hidden"){
	$show_bg = false;
}else{
    $show_bg = true;
}

//bg_visibility
if (isset($_GET['design_color']) && $_GET['design_color']=="black"){
	$design_color = false;
}else{
    $design_color = true;
}


if($orientation != "L" && $orientation != "P"){
	$orientation = "P";
}

if($orientation=="P"){
    $show_logo = false; //always hide the lofo if we are in Portrait mode, Logo will be placed during page creation
}

$title = filter_var($text, FILTER_SANITIZE_STRING);

// Include the main TCPDF library (search for installation path).
require_once('EJCPDF.php');

// create new PDF document
$pdf = new EJCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setMyDefaults($text,"EJC, Signs, directions");

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage($orientation, '', false, false, false, $show_bg);

$fontsize = 72;
$lineheigh = $fontsize+6;
$targetwidth = $pdf->getPageWidth();
$offset=0;
$rotation=-1;
$logo_size = 70;
$logo_x = 30;
$logo_y_offset = 130; 

if($direction==0){
    if($orientation == "L"){
        $offset=70;
        $logo_size = 80;
        $logo_x = ($targetwidth-$logo_size)/2;
        $logo_y_offset = 100; 
    }else{
        $offset=80;
    }
}elseif($direction==1){
    $offset = 160;
    $rotation = 0;
}elseif($direction==2){
    $offset = 160;
    $rotation = 45;
}elseif($direction==3){
    $offset = 160;
    $rotation = 90;
}elseif($direction==4){
    $offset = 160;
    $rotation = 135;
}elseif($direction==5){
    $offset = 160;
    $rotation = 180;
}elseif($direction==6){
    $offset = 160;
    $rotation = 225;
}elseif($direction==7){
    $offset = 160;
    $rotation = 270;
}elseif($direction==8){
    $offset = 160;
    $rotation = 315;
}
if($direction>0 && $direction <= 8 && $orientation =="L"){
    $offset = 110;
}


$pdf->setXY(0,0);
$pdf->setFont($font, '', $fontsize, '', true);
if($design_color){
    $pdf->SetTextColor(255, 80, 0);
}else{
    $pdf->SetTextColor(0,0,0);
}
//$nlines = $pdf->SplitLines($text,$targetwidth);
//$pdf->Cell(0, 0, $text, 0, 1, 'C', 0, '', 0);
$pdf->Multicell(0,$pdf->getPageHeight()-$offset,$text,0,'C',0,1,'','',true,0,false, true, $pdf->getPageHeight()-$offset, 'M');

//add EJC24 Logo
if($show_logo){
    //$pdf->Image('img/ejc24/logo.jpg', $logo_x, $pdf->getPageHeight()-$logo_y_offset, $logo_size, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
}
if($rotation>=0){
    $rotation = map($rotation-90,0,360,0,2*pi());
    //add direction arrow
    $centerX = $pdf->getPageWidth()/2;
    if($orientation=="L"){
        $centerY = 120;
        $arrowLength = 40;
    }else{
        $centerY = 150;
        $arrowLength = 50;
    }
    $pdf->SetLineStyle(array('width' => 5, 'join' => 'round'));
    if($design_color){
        $pdf->SetLineStyle(array('color' => array(255, 80, 0)));
        $pdf->SetFillColor(255,80,0);
    }else{
        $pdf->SetLineStyle(array('color' => array(0, 0, 0)));
        $pdf->SetFillColor(0,0,0);
    }
    $x = cos($rotation) * $arrowLength;
    $y = sin($rotation) * $arrowLength;
    $x1 = $centerX - $x;
    $y1 = $centerY - $y;
    $x2 = $centerX + $x;
    $y2 = $centerY + $y;
    $headstyle = 2;
    $pdf->Arrow($x1,$y1,$x2,$y2,$headstyle,40);
}

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($title.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
