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
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">

<h1>Create Master SKJ</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>