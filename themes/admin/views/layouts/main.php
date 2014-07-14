<?php
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/screen.css');	
	Yii::app()->clientscript
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/font-awesome.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/exstyle.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/datatables.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/buttons.css' )
		//->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.min.css' )
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END )
		//->registerScriptFile( Yii::app()->theme->baseUrl.'/js/jquery.maskMoney.js', CClientScript::POS_BEGIN);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="description" content="">
<meta name="author" content="">


<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
</head>

<body>
		<div class="navbar navbar-fixed-top">
		  <div class="navbar-inner">
		    <div class="container">
		      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </a>
		      <a style="float:left;" class="brand" href="<?php echo Yii::app()->baseUrl;?>">ASESMENT</a>
				<Div style="float:left;">
					<ul class="menu-drop" style="margin-top:0px;margin-bottom:0px;">
					<li><a href="#"><i class="icon-chevron-down"></i>
						<span style="padding-left:10px;" class="currentdeptname"><?php echo (Yii::app()->user->getState('current_departement_name'));?></span>
						</a>
						<div style="max-height:100px;position: relative;">
							<ul>
								<?php $loadDepartement = Departement::model()->loadAll(); ?>
								<?php foreach((array) $loadDepartement as $dept) { ?>
								<li>
								<?php echo CHtml::ajaxLink($dept->name,
											Yii::app()->createUrl('masters/departement/setCurrentDepartement/id/'.$dept->id),
											array( // ajaxOptions
											  'type' => 'GET',
											  /*'beforeSend' => "function( request )
															   {
																 // Set up any pre-sending stuff like initializing progress indicators
															   }",*/
											  'success' => "function( data )
															{
															  $('.currentdeptname').html(data);
															}",
											  //'data' => array( 'val1' => '1', 'val2' => '2' )
											)
										);
								?>
								</li>
								<?php } ?>
								<li><Div style="border-top:1px solid #fff;"><a href="<?php echo Yii::app()->createUrl('masters/departement/create');?>">Buat Departement Baru</a></li>
							</ul>
						</div>
						<div style="clear:both;"></div>
						
					</li>
					</ul>
				</Div>
		      <div class="nav-collapse">
		        	<a class="btn btn-danger pull-right" href="<?php echo Yii::app()->createUrl('site/logout')?>"><b class="icon-off icon-white"></b> Tutup</a>
		      </div><!-- /.nav-collapse -->
		    </div><!-- /.container -->
		  </div><!-- /navbar-inner -->
		</div><!-- /navbar -->
		<div id="sidebar">
			<ul class="menu-sidebar">
			 <?php if ( Yii::app()->user->getIsSuperAdmin() ) { ?>
          <li><a href="<?php echo Yii::app()->createUrl('masters')?>" <?php echo ($this->id == 'default' ? 'class="active"' : '')?>><i class="icon-home"></i> <span>Master</span></a></li>
          <li><a href="<?php echo Yii::app()->createUrl('masters/anggota')?>" ><i class="icon-group"></i> <span>Anggota Admin</span></a></li>
          <li><a href="<?php echo Yii::app()->createUrl('masters/masterasesor')?>" ><i class="icon-group"></i> <span>Asesor</span></a></li>
          <li><a href="<?php echo Yii::app()->createUrl('skj')?>" ><i class="icon-group"></i> <span>SKJ</span></a></li>
          <li><a href="<?php echo Yii::app()->createUrl('masters/peserta')?>" ><i class="icon-group"></i> <span>Peserta</span></a></li>
          <li><a href="<?php echo Yii::app()->createUrl('masters/peserta/rekapitulasi')?>" ><i class="icon-group"></i> <span>Laporan</span></a></li>
			 <?php } ?>
			 
			 <?php if ( Yii::app()->user->getIsAuthor() ) { ?>
          <li><a href="<?php echo Yii::app()->createUrl('#')?>" ><i class="icon-group"></i> <span>Profil</span></a></li>
          
          <li><a href="<?php echo Yii::app()->createUrl('masters/peserta/asesor')?>" ><i class="icon-group"></i> <span>Peserta</span></a></li>
			 <?php } ?>
			 
			 <?php /*<li><a href="forms.html"><i class="icon-edit"></i> <span>Forms</span></a></li>
			 <li><a href="widgets.html"><i class="icon-briefcase"></i> <span>Others</span></a></li>
			 <li><a href="error_404.html"><i class="icon-warning-sign"></i> <span>Errors</span></a></li>
			 <li><a href="messages.html"><i class="icon-gift"></i> <span>Bonus</span></a></li>
			 */?>
			</ul>
	  
		  
		</div>
		<div id="maincontainer">
		<?php echo $content ?>
		</div>
	
	
	
<div class="clear"></div>

    
</body>
</html>
<style type="text/css">

</style>
<script type="text/javascript">
$("a[rel=tooltip]").tooltip({ placement: "below" });
</script>