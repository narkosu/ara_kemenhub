<?php
/* @var $this DeputiController */
/* @var $model Deputi */

$this->breadcrumbs=array(
	'Deputis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Deputi', 'url'=>array('index')),
	array('label'=>'Create Deputi', 'url'=>array('create')),
	array('label'=>'Update Deputi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Deputi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Deputi', 'url'=>array('admin')),
);
?>

<h1>View Deputi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'departement_id',
		'deputi_name',
		'status',
	),
)); ?>
