<?php
/* @var $this JeniskompetensiController */
/* @var $model Jeniskompetensi */

$this->breadcrumbs=array(
	'Jeniskompetensis'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Jeniskompetensi', 'url'=>array('index')),
	array('label'=>'Create Jeniskompetensi', 'url'=>array('create')),
	array('label'=>'Update Jeniskompetensi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Jeniskompetensi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Jeniskompetensi', 'url'=>array('admin')),
);
?>

<h1>View Jeniskompetensi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'departement_id',
		'name',
		'keterangan',
	),
)); ?>
