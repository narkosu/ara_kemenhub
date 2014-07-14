<?php
/* @var $this TingkatjabatanController */
/* @var $model Tingkatjabatan */

$this->breadcrumbs=array(
	'Tingkatjabatans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tingkatjabatan', 'url'=>array('index')),
	array('label'=>'Create Tingkatjabatan', 'url'=>array('create')),
	array('label'=>'Update Tingkatjabatan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tingkatjabatan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tingkatjabatan', 'url'=>array('admin')),
);
?>

<h1>View Tingkatjabatan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'departement_id',
		'tingkat_jabatan',
		'status',
	),
)); ?>
