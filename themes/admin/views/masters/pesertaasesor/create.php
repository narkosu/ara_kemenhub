<?php
/* @var $this PesertaasesorController */
/* @var $model Pesertaasesor */

$this->breadcrumbs=array(
	'Pesertaasesors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pesertaasesor', 'url'=>array('index')),
	array('label'=>'Manage Pesertaasesor', 'url'=>array('admin')),
);
?>

<h1>Create Pesertaasesor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>