<?php
/* @var $this MasterasesorController */
/* @var $model Masterasesor */

$this->breadcrumbs=array(
	'Masterasesors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Masterasesor', 'url'=>array('index')),
	array('label'=>'Create Masterasesor', 'url'=>array('create')),
	array('label'=>'View Masterasesor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Masterasesor', 'url'=>array('admin')),
);
?>

<h1>Update Masterasesor <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>