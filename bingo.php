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

$title = "Convention BINGO!";


//if (isset($_GET['text'])){
//	$text = filter_var($_GET['text'],FILTER_SANITIZE_STRING);
//    //filter_var($_GET['ssid'],FILTER_SANITIZE_STRING);
//}else{
//	$text = "";
//}
//
//if (isset($_GET['direction'])){
//	$direction = filter_var($_GET['direction'],FILTER_SANITIZE_NUMBER_INT);
//}else{
//	$direction = 0;
//}
//
//if (isset($_GET['orientation'])){
//	$orientation = filter_var($_GET['orientation'],FILTER_SANITIZE_STRING);
//}
//
//if($orientation != "L" && $orientation != "P"){
//	$direction = "P";
//}

// Include the main TCPDF library (search for installation path).
require_once('EJCPDF.php');
require_once 'google-api/vendor/autoload.php';

// configure the Google Client
$client = new \Google_Client();
$client->setApplicationName('Convention-Bingo');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
// credentials.json is the key file we downloaded while setting up our Google Sheets API
$path = 'data/google-sheets-credentials.json';
$client->setAuthConfig($path);

// configure the Sheets Service
$service = new \Google_Service_Sheets($client);
$spreadsheetId = '10-rq1HX61tvMxU0GaGHHQPuhqFnRmUtSDiX8_LDgiR0';

// get all the rows of a sheet
$range = 'answers'; // here we use the name of the Sheet to get all the rows
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$rows = $response->getValues();
//$cat_resp = $service->spreadsheets_values->get($spreadsheetId, "categories");
//$cat_rows = $cat_resp->getValues();
$headers = array_shift($rows);
//$cat_headers = array_shift($cat_rows);
//$cat_array = [];
//foreach ($cat_rows as $crow){
//    $crow = array_combine($cat_headers, $crow);
//    $cat_array[$crow["categorie"]]["text_de"]=$crow["text_de"];
//    $cat_array[$crow["categorie"]]["text_en"]=$crow["text_en"];
//    $cat_array[$crow["categorie"]]["default_bg_color"]=$crow["default_bg_color"];
//    $cat_array[$crow["categorie"]]["default_color"]=$crow["default_color"];
//}

$entries = [];
foreach ($rows as $line){
    $line = array_combine($headers, $line);
    if($line["approved"]=="yes"){
        $entries[] = htmlspecialchars($line["Your Word/Phrase:"]);
        //$entries[] = filter_var($line["Your Word/Phrase:"],FILTER_SANITIZE_STRING);
        //print($line["Your Word/Phrase:"]."<br/>");
    }
}


// create new PDF document
$pdf = new EJCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setMyDefaults("Convention BINGO!","EJC, Bingo, Volunteering");

function createBingo($pdf_handle, $game_entries){
    global $font;
    if (count($game_entries)<25){
        print "not enought entries for Bingo Card! Currently only ".count($entries)." valid entries";
        exit;
    }
    shuffle($game_entries);

    
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf_handle->AddPage("P", showOrnaments:false);

    $fontsize = 72;
    $lineheigh = $fontsize+6;
    $targetwidth = $pdf_handle->getPageWidth();
    $offset=0;
    $rotation=-1;

    $bingo_padding = 30;
    $bingo_offset = 80;

    $bingo_size = ($targetwidth-$bingo_padding)/5;

    //if($direction==0){
    //    if($orientation == "L"){
    //        $offset=20;
    //    }else{
    //        $offset=60;
    //    }
    //}elseif($direction==1){
    //    $offset = 160;
    //    $rotation = 0;
    //}elseif($direction==2){
    //    $offset = 160;
    //    $rotation = 45;
    //}elseif($direction==3){
    //    $offset = 160;
    //    $rotation = 90;
    //}elseif($direction==4){
    //    $offset = 160;
    //    $rotation = 135;
    //}elseif($direction==5){
    //    $offset = 160;
    //    $rotation = 180;
    //}elseif($direction==6){
    //    $offset = 160;
    //    $rotation = 225;
    //}elseif($direction==7){
    //    $offset = 160;
    //    $rotation = 270;
    //}elseif($direction==8){
    //    $offset = 160;
    //    $rotation = 315;
    //}
    //if($direction>0 && $direction <= 8 && $orientation =="L"){
    //    $offset = 110;
    //}


    $pdf_handle->setXY(0,20);
    $pdf_handle->setFont($font, '', $fontsize, '', true);
    //$nlines = $pdf->SplitLines($text,$targetwidth);
    //$pdf->Cell(0, 0, $text, 0, 1, 'C', 0, '', 0);
    $pdf_handle->Multicell(0,0,"BINGO",0,'C',0,1,'','',true,0,false, true, 0, 'M');

    $counter = 0;

    $pdf_handle->setFont($font, '', $fontsize/6, '', true);
    foreach (array_rand($game_entries, 25) as $index){
        $row = $counter%5;
        $col = intdiv($counter, 5);
        $x = $col*$bingo_size+$bingo_padding/2;
        $y = $row*$bingo_size+$bingo_offset;
        $pdf_handle->setXY($x,$y);
        //$pdf->Cell($bingo_size, $bingo_size, $entries[$index], 1, 0, "C", 0, 0, 0, 0, "C", "M");
        $pdf_handle->Multicell($bingo_size, $bingo_size, $game_entries[$index], "LTRB", "C", 0, 0, maxh: $bingo_size, valign:"M"); 
        //#MultiCell(w, h, txt, border = 0, align = 'J', fill = 0, ln = 1, x = '', y = '', reseth = true, stretch = 0, ishtml = false, autopadding = true, maxh = 0)
        $counter++;
    }
}

if (isset($_GET['number'])){
    $number = filter_var($_GET['number'],FILTER_SANITIZE_NUMBER_INT);
}else{
    $number = 1;
}
foreach (range(1,$number) as $page){
    createBingo($pdf, $entries);    
}

//if($rotation>=0){
//    $rotation = map($rotation-90,0,360,0,2*pi());
//    //add direction arrow
//    $centerX = $pdf->getPageWidth()/2;
//    if($orientation=="L"){
//        $centerY = 120;
//        $arrowLength = 40;
//    }else{
//        $centerY = 150;
//        $arrowLength = 50;
//    }
//    $pdf->SetLineStyle(array('width' => 5, 'join' => 'round'));
//    $x = cos($rotation) * $arrowLength;
//    $y = sin($rotation) * $arrowLength;
//    $x1 = $centerX - $x;
//    $y1 = $centerY - $y;
//    $x2 = $centerX + $x;
//    $y2 = $centerY + $y;
//    $headstyle = 2;
//    $pdf->Arrow($x1,$y1,$x2,$y2,$headstyle,40);
//}

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($title.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
