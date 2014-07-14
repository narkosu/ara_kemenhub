<?php
/* @var $this DeputiController */
/* @var $model Deputi */

$this->breadcrumbs=array(
	'Deputis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Deputi', 'url'=>array('index')),
	array('label'=>'Manage Deputi', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Create Deputi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>