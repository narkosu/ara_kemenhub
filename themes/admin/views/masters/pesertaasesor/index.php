<?php
/* @var $this PesertaasesorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pesertaasesors',
);

$this->menu=array(
	array('label'=>'Create Pesertaasesor', 'url'=>array('create')),
	array('label'=>'Manage Pesertaasesor', 'url'=>array('admin')),
);
?>

<h1>Pesertaasesors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
