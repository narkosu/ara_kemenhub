<?php
$cs=Yii::app()->clientScript;
//$baseUrl=$this->module->assetsUrl;
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/screenprint.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/prints.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/screenprint.css?s=print','print');
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/prints.css?s=print','print');
$cs->registerScript('print', "
    $('div .print a').click(function() {
	window.print();
	return false;
    });
    ");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="" > 
<head> 
    <title><?php echo $this->pageTitle; ?></title> 
    <meta name="robots" content="NONE,NOARCHIVE" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<style>
    @media print {
	div.print { display: none;}	
	thead, tr.pagebrak {page-break-before: always}

	table { page-break-after:auto; }
	tr    { page-break-inside:avoid; page-break-after:auto }
	td    { page-break-inside:avoid; page-break-after:auto }
	thead { display:table-header-group }
	tfoot { display:table-footer-group }
    }
</style>
</head> 
<body class="dashboard"> 
    <div id="container">
	
    <!-- CONTENT --> 
    <div id="content" class="content-flexible"> 
	<div class="print"><a href="#print">Print / Cetak</a></div>
        <?php
            echo $content;
        ?>
        <br class="clear" /> 
        </div>     
        
    </div> 
</body> 
</html> 
 
