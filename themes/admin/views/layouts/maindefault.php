<?php
$cs=Yii::app()->clientScript;
//$baseUrl=$this->module->assetsUrl;
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/base.css');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="" > 
<head> 
    <title><?php echo $this->pageTitle; ?></title> 
    <meta name="robots" content="NONE,NOARCHIVE" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head> 
<body class="dashboard"> 
    <div id="container"> 

<div id="header"> 
    <div class="branding">&nbsp;</div> 
    <div class="admin-title"><?php echo Yii::app()->name?> Administration</div> 
    
        <ul id="user-tools"> 
            <!--<li><a href="#" class="user-options-handler collapse-handler">username</a></li>-->
            <li><a href="<?php echo $this->createUrl('/site/logout'); ?>" class="user-options-handler collapse-handler">
      
      <?php  echo Yii::app()->user->name; ?></a></li>
        </ul> 
</div> 
    <?php 
        $message=Yii::app()->user->getFlash('flashMessage');
        if ($message): 
    ?> 
    <ul class="messagelist">
        <li><?php echo $message; ?></li>
    </ul>
    <?php endif; ?>

    <!-- BREADCRUMBS --> 
    <div id="breadcrumbs">
    <?php $this->widget('application.extensions.emenu.EMenu',array(
      'theme'=>'flickr.com',
      'items'=>array(
          array('label'=>'Struktur Organisasi', 'url'=>array('/strukturorg')),
          
          array('label'=>'Pegawai', 'url'=>array('/pegawai')),
          array('label'=>'Prediksi Pensiun', 'url'=>array('/pegawai/prediksipensiun')),
          array('label'=>'Daftar pengguna', 'url'=>array('/member'), 'visible'=>(!Yii::app()->user->isGuest && Yii::app()->user->level == 'admin')),
          
          array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
          //array('label'=>'Logout', 'url'=>array('/userGroups/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
        ),
        ));?>

    </div>
        
    <!-- CONTENT --> 
    <div id="content" class="content-flexible" style="margin-top:20px;"> 
 
        <?php
            echo $content;
        ?>
        <br class="clear" /> 
        </div>     
        <!-- FOOTER --> 
        <div id="footer"></div> 
        
    </div> 
</body> 
</html> 
 
