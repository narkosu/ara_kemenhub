<?php
/* @var $this KompetensiController */
/* @var $model Kompetensi */

$this->breadcrumbs=array(
	'Kompetensis'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Kompetensi', 'url'=>array('index')),
	array('label'=>'Create Kompetensi', 'url'=>array('create')),
	array('label'=>'Update Kompetensi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kompetensi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kompetensi', 'url'=>array('admin')),
);
?>

<h1>View Kompetensi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'departement_id',
		'jeniskompetensi_id',
		'name',
		'alias',
		'nilai',
		'status',
	),
)); ?>
