<?php
/* @var $this TingkatjabatanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tingkatjabatans',
);

$this->menu=array(
	array('label'=>'Create Tingkatjabatan', 'url'=>array('create')),
	array('label'=>'Manage Tingkatjabatan', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Tingkatjabatan</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tingkatjabatan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'dept.name',
		'tingkat_jabatan',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>