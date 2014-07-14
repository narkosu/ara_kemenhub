<?php
/* @var $this DeputiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Deputis',
);

$this->menu=array(
	array('label'=>'Create Deputi', 'url'=>array('create')),
	array('label'=>'Manage Deputi', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Master Deputi</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'departement-grid',
	'dataProvider'=>$dataProvider->search(),
	'filter'=>$dataProvider,
	'columns'=>array(
		'id',
		'dept.name',
		'deputi_name',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
