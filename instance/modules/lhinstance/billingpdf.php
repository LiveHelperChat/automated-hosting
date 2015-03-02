<?php 

require_once('extension/instance/classes/tcpdf_min/tcpdf.php');

$invoice = erLhcoreClassModelInstanceInvoice::fetch((int)$Params['user_parameters']['id']);

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('LHC');
$pdf->SetTitle('Invoice');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('freeserif', 'B', 14);

// add a page
$pdf->AddPage();

$cfg = erConfigClassLhConfig::getInstance();

// set some text to print
$txt = $cfg->getSetting('site','seller_attributes');
// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$pdf->SetY(25);
		
// set some text to print
//$txt = "Buyer\nremdex@gmail.com";
$txt = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Date Issued') . ": ".date('Y-m-d',$invoice->odate)."\n";
$txt .= erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Invoice number') . ": ".date('Ymd',$invoice->odate).$invoice->id;



// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'R', true, 0, false, false, 0);

// set font
$pdf->SetFont('freeserif', '', 10);

// ---------------------------------------------------------
//$pdf->SetX(0);
$pdf->SetY(65);
$pdf->writeHTML("
		
<table  border=\"1\">
<tr>
		<th><b>".erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Desciption')."</b></th>
		<th><b>".erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Price')."</b></th>
</tr>		
<tr>
	<td>{$invoice->option_selection1}</td>		
	<td>{$invoice->price_front}</td>		
</tr>
</table>
");
$pdf->Write(0, erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Total').": ".$invoice->price_front, '', 0, 'R', true, 0, false, false, 0);

$pdf->SetFont('freeserif', '', 14);
$pdf->writeHTML(erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Bill to').":<br/>".$invoice->customer_name
);

//Close and output PDF document
$pdf->Output('invoice_'.date('Ymd',$invoice->odate).$invoice->id.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
exit;
?>