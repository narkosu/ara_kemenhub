<?php
/* @var $this ItemskjController */
/* @var $model Itemskj */

$this->breadcrumbs=array(
	'Itemskjs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Itemskj', 'url'=>array('index')),
	array('label'=>'Manage Itemskj', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_submenu'); ?>
<div class="container-page">
<div style="padding:10px 0px 0px 0px;font-weight:bold;border-bottom:1px solid #eee;"><?php echo $masterskj->skj_name;?></div>

<h1>Create Itemskj</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'params'=>$params)); ?>
</div>