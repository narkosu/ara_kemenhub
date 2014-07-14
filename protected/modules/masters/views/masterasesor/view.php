<?php
/* @var $this MasterasesorController */
/* @var $model Masterasesor */

$this->breadcrumbs=array(
	'Masterasesors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Masterasesor', 'url'=>array('index')),
	array('label'=>'Create Masterasesor', 'url'=>array('create')),
	array('label'=>'Update Masterasesor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Masterasesor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Masterasesor', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>
<div id="subcontainer">

<h1>View Masterasesor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kode_asesor',
		'nama_asesor',
		'telpon_asesor',
	),
)); ?>
</div>