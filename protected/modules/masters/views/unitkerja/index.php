<?php
/* @var $this UnitkerjaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Unitkerjas',
);

$this->menu=array(
	array('label'=>'Create Unitkerja', 'url'=>array('create')),
	array('label'=>'Manage Unitkerja', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Unitkerja</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unitkerja-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'dept.name',
		'deput.deputi_name',
		'unitkerja_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
