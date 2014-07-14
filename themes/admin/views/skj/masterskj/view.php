<?php
/* @var $this MasterskjController */
/* @var $model Masterskj */

$this->breadcrumbs=array(
	'Masterskjs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Masterskj', 'url'=>array('index')),
	array('label'=>'Create Masterskj', 'url'=>array('create')),
	array('label'=>'Update Masterskj', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Masterskj', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Masterskj', 'url'=>array('admin')),
);
?>

<h1>View Masterskj #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'departement_id',
		'skj_name',
		'status',
	),
)); ?>
