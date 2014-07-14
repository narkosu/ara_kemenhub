<?php
/* @var $this UnitkerjaController */
/* @var $model Unitkerja */

$this->breadcrumbs=array(
	'Unitkerjas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Unitkerja', 'url'=>array('index')),
	array('label'=>'Create Unitkerja', 'url'=>array('create')),
	array('label'=>'Update Unitkerja', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Unitkerja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Unitkerja', 'url'=>array('admin')),
);
?>

<h1>View Unitkerja #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'departement_id',
		'deputi_id',
		'unitkerja_name',
	),
)); ?>
