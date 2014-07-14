<?php
/* @var $this DepartementController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs=array(
	'Departements',
);

$this->menu=array(
	array('label'=>'Create Departement', 'url'=>array('create')),
	array('label'=>'Manage Departement', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
	<h1>Departements</h1>
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'departement-grid',
	'dataProvider'=>$dataProvider->search(),
	'filter'=>$dataProvider,
	'columns'=>array(
		'id',
		'name',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php // $widget->run(); ?>
</div>