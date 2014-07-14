<?php
/* @var $this ItemskjController */
/* @var $model Itemskj */

$this->breadcrumbs=array(
	'Itemskjs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Itemskj', 'url'=>array('index')),
	array('label'=>'Create Itemskj', 'url'=>array('create')),
	array('label'=>'Update Itemskj', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Itemskj', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Itemskj', 'url'=>array('admin')),
);
?>

<h1>View Itemskj #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'skj_id',
		'departement_id',
		'deputi_id',
		'unitkerja_id',
		'jabatan_id',
		'tingkatjabatan_id',
		'rumpunjabatan_id',
		'status',
	),
)); ?>
