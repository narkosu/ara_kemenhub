<?php
/* @var $this MasterskjController */
/* @var $model Masterskj */

$this->breadcrumbs=array(
	'Masterskjs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Masterskj', 'url'=>array('index')),
	array('label'=>'Create Masterskj', 'url'=>array('create')),
	array('label'=>'View Masterskj', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Masterskj', 'url'=>array('admin')),
);
?>

<h1>Update Masterskj <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>