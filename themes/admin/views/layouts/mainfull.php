<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bangladvisor</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
</head>
<body>
<!-- wrapper start -->
<div id="wrapper">
	
  <!-- header start -->
  <div id="header">
  	
    <!-- logo -->
    <div class="logo">
    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" alt="logo" border="0" /></a>
    </div>
    <!-- logo end -->
    
    <!-- topmenu-->
    <div id="topright">
		
    	<ul id="topmenu">
      	<?php if ( !Yii::app()->user->isGuest ) { ?> <li>Hi, <b><?php echo Yii::app()->user->name ?></b></li><?php } ?>
      	<li><a href="<?php echo Yii::app()->createUrl('/')?>">HOME</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('/site/page')?>">ABOUT US</a></li>
        <li class="signup"><?php if ( Yii::app()->user->isGuest ) { ?><a href="#">SIGN UP <span class="red">(FREE)</span></a><?php } else { ?><a href="<?php echo Yii::app()->createUrl('site/logout')?>">SIGN OUT </a><?php } ?></li>
      </ul>      
    </div>
    <div id="topright2">
    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/fb.png" alt="fb" border="0" /></a>
      <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/tw.png" alt="tw" border="0" /></a>
    </div>
    <!-- topmenu end-->
  
  </div>
  <!-- header end -->
	
  <!-- form start -->
  <div id="searchform">
  	<form name="form" method="get" action="<?php echo Yii::app()->createUrl('/advisor/search/');?>">
    	<input type="text" name="query" value="<?php echo !empty($_GET['query']) ? $_GET['query'] : '';?>"class="text" /><input type="submit" value="SEARCH" class="btnsearch" />
      <a href="<?php echo Yii::app()->createUrl('advisor/writereview')?>" class="btnreview">WRITE REVIEW</a>
      <a href="" class="btnfactory">INCLUDE A FACTORY</a>
    <div class="boo-clr"></div>
    </form>
  </div>
  <!-- form end -->
    
  <!-- container start -->
	<div id="container">
  
    <div id="left-container">      
		<?php echo $content ?>
    
    </div>
    
    <!-- right column start -->
   
    <!-- right column end -->
    
  <div class="boo-clr"></div>  
  </div>
  <!-- container end -->
<div class="boo-clr"></div> 	
</div>
<!-- wrapper end -->

<!-- footer start -->
<div id="wrapper-footer">
	<div id="box-footer">
    <div id="box-footer-l">
      <a href="#">Home</a>|<a href="#">Term Of Use</a>|<a href="#">Privacy Policy</a>|<a href="#">Help</a><br />
      &copy; 2011 <a href="#"><span class="bangla">BANGL</span><span class="advisor">ADVISOR</span></a>. All rights reserved.
    </div>
    <div id="box-footer-r">
      <a href="http://validator.w3.org/check?uri=referer" target="_blank">
      	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/html_valid.png" alt="html valid" border="0" /></a>
      <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
      	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/css_valid.png" alt="css valid" border="0" /></a>
    </div>
  </div>
</div>
<!-- footer end -->
</body>
</html>
