<?php
/* @var $this MasterasesorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Masterasesors',
);

$this->menu=array(
	array('label'=>'Create Masterasesor', 'url'=>array('create')),
	array('label'=>'Manage Masterasesor', 'url'=>array('admin')),
);
?>

<h1>Masterasesors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
