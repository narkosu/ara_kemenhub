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

<h1>Create Masterasesor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>