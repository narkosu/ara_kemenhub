<?php
/* @var $this KompetensiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kompetensis',
);

$this->menu=array(
	array('label'=>'Create Kompetensi', 'url'=>array('create')),
	array('label'=>'Manage Kompetensi', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_submenu'); ?>
<div id="subcontainer">
<h1>Kompetensis</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kompetensi-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'dept.name',
		array('header'=>'Jenis Kompetensi','name'=>'jenkom.name'),
		'name',
		'alias',
		'nilai',
		/*
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
