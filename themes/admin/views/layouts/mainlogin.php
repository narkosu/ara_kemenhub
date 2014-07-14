<?php
$cs=Yii::app()->clientScript;
//$baseUrl=$this->module->assetsUrl;
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/default-ls.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/default-style_ls.css');


?>
<!DOCTYPE html>
<html><head>

    <title><?php echo Yii::app()->name?></title>
    
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
   
    <div id="landing-page-container" class="locale_en">
      <div id="logoArea">
        
      </div>
      <div id="background-container" class="ls-track">
        <img alt="Lemhannas" src="<?php echo Yii::app()->baseUrl?>/images/logo.jpg" style="margin-left:150px;margin-top:100px;">
      </div>
      <div style="overflow: visible;" id="steps-container">
        <div id="whiteBox-mask"></div>
        <div id="processing-container"><div id="processing">processing...</div></div>
        <ul id="steps">
                    <!-- City Picker and Email Submission Steps -->
          <li class="step" id="city-and-email-step">
  <div class="insideBox step-body boxlogin">
	
    <div class="headlineArea">
	
	<?php echo $content ?>
  </div>
  
</li>
        </ul>
      </div>
    <br style="clear:both">
    </div>
   
  </body></html>

