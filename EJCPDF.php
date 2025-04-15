<?php 

require_once('tcpdf/tcpdf.php');

class EJCPDF extends TCPDF{
    public function AddPage($orientation='P', $format='', $keepmargins=false, $tocpage=false, $showOrnaments = true){
        parent::AddPage($orientation, $format, $keepmargins, $tocpage);
        $this->SetMargins(0, 0, 0, true);
        $this->SetFooterMargin(0);
        $this->setxy(0,30);
        $this->SetAutoPageBreak(TRUE, 0);
        $this->setTextShadow(array('enabled'=>false, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        if($orientation == "P"){
            //$this->Image('img/bg.jpg', 0, 0, $this->getPageWidth(), 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
            if($showOrnaments){
                $this->Image('img/ejc24/logo.jpg', 10, 10, 35, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);

                //rotate following image
                // Start Transformation
                //$this->StartTransform();
                //$this->Rotate(-35, 170, 255);
                //$this->Image('img/ejc24/elem1.jpg', 170, 255, 30, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
                //$this->StopTransform();

                //$this->Image('img/ejc24/elem2.jpg', 20, 260, 30, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
                //$this->Image('img/ejc24/elem3.jpg', 170, 10, 20, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
                //$this->Image('img/bg.jpg', 0, 0, $this->getPageWidth(), 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
                //$this->Image('img/ornament_2.jpg', 20, 210, 30, 0, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
                //$this->Image('img/ornament_1.jpg', 150, 200, 40, 0, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
            }
            $this->setPageMark(); //needed to display cell border for bingo on top of background image
            //$this->Image('img/banner.jpg', 20, 210, $this->getPageWidth(), 0, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        }elseif($orientation == "L"){
            //$this->Image('img/bg-L.jpg', 0, 0, $this->getPageWidth(), 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
            if($showOrnaments){
                //$this->Image('img/ornament_2.jpg', 30, 40, 30, 0, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
                //$this->Image('img/ornament_1.jpg', 240, 130, 40, 0, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
                //$this->StartTransform();
                //$img_x = 20;
                //$img_y = 170;
                //$img_size = 30;
                //$this->Rotate(200, $img_x+$img_size/2, $img_y+$img_size/2);
                //$this->Image('img/ejc24/elem1.jpg', $img_x, $img_y, $img_size, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
                //$this->StopTransform();

                //$this->Image('img/ejc24/elem2.jpg', 240, 150, 30, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
                //$this->Image('img/ejc24/elem3.jpg', 0, 10, 20, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
            }
            $this->setPageMark();
        }
        $this->SetXY(10, $this->getPageHeight()-6);
        $this->setFont("dejavusans", '', 7, '', true);
        $this->SetTextColor(200,200,200);
        $this->cell(0, 0, "generated at ".date('d.m.Y - H:i'), 0, 1, 'L', 0, '', 0);
        $this->SetXY(0,35);
        $this->SetTextColor(0,0,0);
        $this->SetLineWidth(0.5);
    }

    public function setMyDefaults($title="", $keywords="", $font="dejavusans"){
        // set document information
        $this->setCreator(PDF_CREATOR);
        $this->setAuthor('Niklas Aumüller');
        $this->setTitle($title);
        $this->setSubject($title);
        $this->setKeywords($keywords);

        // set default header data
        $this->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $this->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


        //disable header and footer
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);

        // set default monospaced font
        $this->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $this->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->setHeaderMargin(PDF_MARGIN_HEADER);
        $this->setFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        	require_once(dirname(__FILE__).'/lang/eng.php');
        	$this->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $this->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $this->setFont($font, '', 14, '', true);
    }

}


?>