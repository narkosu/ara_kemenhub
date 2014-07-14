<?php
/* @var $this JabatanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jabatans',
);

$this->menu=array(
	array('label'=>'Create Jabatan', 'url'=>array('create')),
	array('label'=>'Manage Jabatan', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Jabatans</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'jabatan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'dept.name',
		'deput.deputi_name',
		'uk.unitkerja_name',
		'jabatan_name',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>