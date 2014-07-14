<?php
/* @var $this PesertaasesorController */
/* @var $model Pesertaasesor */

$this->breadcrumbs=array(
	'Pesertaasesors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pesertaasesor', 'url'=>array('index')),
	array('label'=>'Create Pesertaasesor', 'url'=>array('create')),
	array('label'=>'Update Pesertaasesor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pesertaasesor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pesertaasesor', 'url'=>array('admin')),
);
?>

<h1>View Pesertaasesor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_departemen',
		'id_peserta',
		'id_asesor',
	),
)); ?>
