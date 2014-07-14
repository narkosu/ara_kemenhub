<?php
/* @var $this MasterskjController */
/* @var $model Masterskj */

$this->breadcrumbs=array(
	'Masterskjs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Masterskj', 'url'=>array('index')),
	array('label'=>'Manage Masterskj', 'url'=>array('admin')),
);
?>
<div class="header-page">
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">Tambah SKJ Baru</h2>
	</div>
	<div style="float:right;">
		<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="container-page">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>