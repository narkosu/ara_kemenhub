<?php
/* @var $this MasterasesorController */
/* @var $model Masterasesor */

$this->breadcrumbs=array(
	'Masterasesors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Masterasesor', 'url'=>array('index')),
	array('label'=>'Manage Masterasesor', 'url'=>array('admin')),
);
?>

<div class="header-page">
	
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">Asessor Baru</h2>
	</div>
	<div style="float:right;">
		<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
	
</div>

<div class="container-page">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	<div style="clear: both"></div>
</div>