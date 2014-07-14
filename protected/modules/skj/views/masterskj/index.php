<?php
/* @var $this MasterskjController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Masterskjs',
);

$this->menu=array(
	array('label'=>'Create Masterskj', 'url'=>array('create')),
	array('label'=>'Manage Masterskj', 'url'=>array('admin')),
);
?>

<h1>Masterskjs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
