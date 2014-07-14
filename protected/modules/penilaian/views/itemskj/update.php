<?php
/* @var $this ItemskjController */
/* @var $model Itemskj */

$this->breadcrumbs=array(
	'Itemskjs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Itemskj', 'url'=>array('index')),
	array('label'=>'Create Itemskj', 'url'=>array('create')),
	array('label'=>'View Itemskj', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Itemskj', 'url'=>array('admin')),
);
?>

<h1>Update Itemskj <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'itemkompetensi'=>$itemkompetensi)); ?>